<?php

namespace backend\controllers;

use backend\models\AccdailyBal;
use backend\models\Account;
use backend\models\ContractAmountReduceDue;
use backend\models\ContractBalance;
use backend\models\ContractMaster;
use backend\models\Customer;
use backend\models\EventType;
use backend\models\GeneralLedger;
use backend\models\GlDailyBalance;
use backend\models\ProductAccrole;
use backend\models\ReferenceIndex;
use backend\models\SystemDate;
use backend\models\TodayEntry;
use Yii;
use backend\models\ContractPayment;
use backend\models\ContractPaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContractPaymentController implements the CRUD actions for ContractPayment model.
 */
class ContractPaymentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ContractPayment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContractPaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContractPayment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ContractPayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContractPayment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionCreatePayment($id,$amount)
    {
        //fetches details from the schedule by id
        $schedule=$this->findSchedule($id);


        //fetches settlement account of the loan to update its balance
        $settleAccount=ContractMaster::getSettleAccount($schedule->contract_ref_number);
        if($settleAccount!=null) {


            //updates account balance
            TodayEntry::saveEntry(
                $module = 'DE',
                'CSHD'.SystemDate::getSystemReference(),
                SystemDate::getCurrentDate(),
                $schedule->account_due,
                Customer::getBranchByCustomerNo($schedule->customer_number),
                $amount,
                $ind = 'C',
                $schedule->customer_number,
                ContractMaster::getLoanProduct($schedule->contract_ref_number),
                SystemDate::getCurrentDate(),
                EventType::INIT
            );
            AccdailyBal::updateAccountBalance($settleAccount,$amount,'C');



            if ($schedule->monthly_payment == $amount) {

                $loanProduct=ContractMaster::getLoanProduct($schedule->contract_ref_number);
                if($loanProduct!=null) {



                    //saves to today's transactions
                    //gets accounting roles and events
                    $role_events=ProductAccrole::getRoleEvents($loanProduct,$event=EventType::LQD);
                    if($role_events!=null){
                        foreach($role_events as $role_event){
                            if($role_event->dr_cr_indicator=='D'){


                                //saves customer leg
                                TodayEntry::saveEntry(
                                    $module = 'LD',
                                    $schedule->contract_ref_number,
                                    SystemDate::getCurrentDate(),
                                    $schedule->account_due,
                                    Customer::getBranchByCustomerNo($schedule->customer_number),
                                    $amount,
                                    $ind = 'D',
                                    $schedule->customer_number,
                                    $loanProduct,
                                    SystemDate::getCurrentDate(),
                                    $event
                                );

                                //updates customer account balance

                                AccdailyBal::updateAccountBalance($settleAccount,$amount,'D');



                            }elseif($role_event->dr_cr_indicator=='C'){

                                //saves GL leg
                                TodayEntry::saveEntry(
                                    $module = 'LD',
                                    $schedule->contract_ref_number,
                                    SystemDate::getCurrentDate(),
                                    $role_event->mis_head,
                                    Customer::getBranchByCustomerNo($schedule->customer_number),
                                    $amount,
                                    $ind = 'C',
                                    $schedule->customer_number,
                                    $loanProduct,
                                    SystemDate::getCurrentDate(),
                                    $event
                                );




                                //updates GL balance

                                GlDailyBalance::updateGLBalance($role_event->mis_head,$amount,'C');


                            }
                        }

                    $model = new ContractPayment();
                    $model->credit = $amount;
                    $model->trn_dt = $schedule->due_date;
                    $model->contract_ref_number = $schedule->contract_ref_number;
                    $model->auth_stat = 'U';
                    $model->maker_id = Yii::$app->user->identity->username;
                    $model->maker_time = SystemDate::getCurrentDate() . ' ' . date('H:i:s');
                    $model->balance = ContractPayment::getLastBalance($schedule->contract_ref_number) - $amount;
                    if($model->balance<0){
                        $model->balance=0.00;
                        ContractMaster::updateAll(['contract_status'=>'L'],['contract_ref_no'=>$schedule->contract_ref_number]);
                    }
                    $model->transaction_type = ContractPayment::REPAYMENT;
                    $model->debit = 0.00;
                    if ($model->save()) {
                        $schedule->interest_amount_settled = $schedule->interest_amount_due;
                        $schedule->principal_amount_settled = $schedule->principal_amount_due;
                        $schedule->status = 'L';
                        if($schedule->save()){
                            $remainBalance=ContractBalance::getOutstanding($schedule->contract_ref_number);
                            $remainBalance=$remainBalance-$amount;
                            ContractBalance::updateAll(['contract_outstanding'=>$remainBalance],['contract_ref_number'=>$schedule->contract_ref_number]);
                        }

                    }
                }
                else{
                    echo 'Loan has no product';
                }
            }
        }else{
            echo 'No settlement Account maintained';
        }
        }

    }

    /**
     * Updates an existing ContractPayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ContractPayment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ContractPayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContractPayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContractPayment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findSchedule($id)
    {
        if (($model = ContractAmountReduceDue::findOne($id)) !== null) {
            return $model;
        } else {
           return '';
        }
    }



}
