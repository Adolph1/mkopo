<?php

namespace backend\controllers;

use backend\models\ContractBalance;
use backend\models\ContractMaster;
use backend\models\Customer;
use backend\models\CustomerBalance;
use backend\models\EventType;
use backend\models\Payment;
use backend\models\ProductAccrole;
use backend\models\SystemDate;
use backend\models\TodayEntry;
use Yii;
use backend\models\ContractAmountDue;
use backend\models\ContractAmountDueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\LoginForm;

/**
 * ContractAmountDueController implements the CRUD actions for ContractAmountDue model.
 */
class ContractAmountDueController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ContractAmountDue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContractAmountDueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=100;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContractAmountDue model.
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
     * Creates a new ContractAmountDue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContractAmountDue();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ContractAmountDue model.
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

    //update components amounts

    public function actionPayment()
    {
        $model1 = new ContractAmountDue();
        if ($model1->load(Yii::$app->request->post()) && $model1->save()) {
            return $this->redirect(['view', 'id' => $model1->id]);
        } else {
            return $this->render('update', [
                'model1' => $model1,
            ]);
        }
    }


    public function actionLiquidate($id)
    {
        $model= $this->findModel($id);
        $balance=CustomerBalance::getBalance($model->customer_number);
        $contract_balance=ContractBalance::getOutstanding($model->contract_ref_number);

        if($balance>=$model->amount_due) {
            $newbalance=$balance-$model->amount_due;
            $model->amount_settled = $model->amount_due;
            $model->status = 'L';
            if ($model->save()) {
                $payment = new Payment();
                $payment->amount_paid = $model->amount_settled;
                $payment->contract_ref_number = $model->contract_ref_number;
                $payment->component = $model->component;
                $payment->due_date = $model->due_date;
                $payment->trn_dt = date('Y-m-d');
                $payment->related_customer = $model->customer_number;
                $payment->contract_amount_due_id=$model->id;
                $payment->maker_id = Yii::$app->user->identity->username;
                $payment->maker_time = date('Y-m-d:h:i:s');
                if ($payment->save()) {
                    $contract_balance=$contract_balance-$model->amount_due;
                    ContractBalance::updateAll(['contract_outstanding'=>$contract_balance],['contract_ref_number'=>$model->contract_ref_number]);
                    CustomerBalance::updateAll(['current_balance'=>$newbalance],['customer_number'=>$model->customer_number]);
                    return $this->redirect(['contract-master/schedule', 'id' => $model->contract_ref_number]);
                }
            }
        }
        else{
            Yii::$app->session->setFlash('danger', 'The customer has insufficient balance to make installment.');
            return $this->redirect(['contract-master/schedule', 'id' => $model->contract_ref_number]);
        }

    }


    public function actionPreLiquidate($id)
    {
        $model = $this->findModel($id);
        $balance = CustomerBalance::getBalance($model->customer_number);
        $contract_balance = ContractBalance::getOutstanding($model->contract_ref_number);
        $contract = ContractMaster::getContract($model->contract_ref_number);

        if ($balance >= $model->amount_due) {
            $newbalance = $balance - $model->amount_due;
            $model->amount_settled = $model->amount_due;
            $model->status = 'L';
            if ($model->save()) {
                $payment = new Payment();
                $payment->amount_paid = $model->amount_settled;
                $payment->contract_ref_number = $model->contract_ref_number;
                $payment->component = $model->component;
                $payment->due_date = $model->due_date;
                $payment->trn_dt = date('Y-m-d');
                $payment->related_customer = $model->customer_number;
                $payment->contract_amount_due_id = $model->id;
                $payment->maker_id = Yii::$app->user->identity->username;
                $payment->maker_time = date('Y-m-d:h:i:s');
                if ($payment->save()) {
                    $contract_balance = $contract_balance - $model->amount_due;
                    ContractBalance::updateAll(['contract_outstanding' => $contract_balance], ['contract_ref_number' => $model->contract_ref_number]);
                    CustomerBalance::updateAll(['current_balance' => $newbalance], ['customer_number' => $model->customer_number]);

                    $role_events = ProductAccrole::getRoleEvents($produtcode = $contract->product, $event = EventType::LQD);
                    if ($role_events != null) {
                        foreach ($role_events as $role_event) {
                            if ($role_event->dr_cr_indicator == 'D') {
                                TodayEntry::saveEntry($module = 'LD', $contract->contract_ref_no, SystemDate::getCurrentDate(), $contract->customer_number, $contract->branch, $model->amount_settled, $role_event->dr_cr_indicator, $contract->customer_number, $contract->product, SystemDate::getCurrentDate());
                            } elseif ($role_event->dr_cr_indicator == 'C') {
                                TodayEntry::saveEntry($module = 'LD', $contract->contract_ref_no, SystemDate::getCurrentDate(), $role_event->mis_head, $contract->branch, $model->amount_settled, $role_event->dr_cr_indicator, $contract->customer_number, $contract->product, SystemDate::getCurrentDate());
                            }
                        }
                        return $this->redirect(['contract-master/view', 'id' => $model->contract_ref_number]);
                    }


                }
            } else {
                Yii::$app->session->setFlash('danger', 'The customer has insufficient balance to make installment.');
                return $this->redirect(['contract-master/view', 'id' => $model->contract_ref_number]);
            }

        }
    }

    public function actionQuickLiquidate($id)
    {
        $model= $this->findModel($id);
        $balance=CustomerBalance::getBalance($model->customer_number);
        $contract_balance=ContractBalance::getOutstanding($model->contract_ref_number);

        if($balance>=$model->amount_due) {
            $newbalance=$balance-$model->amount_due;
            $model->amount_settled = $model->amount_due;
            $model->status = 'L';
            if ($model->save()) {
                $payment = new Payment();
                $payment->amount_paid = $model->amount_settled;
                $payment->contract_ref_number = $model->contract_ref_number;
                $payment->component = $model->component;
                $payment->due_date = $model->due_date;
                $payment->trn_dt = date('Y-m-d');
                $payment->related_customer = $model->customer_number;
                $payment->contract_amount_due_id=$model->id;
                $payment->maker_id = Yii::$app->user->identity->username;
                $payment->maker_time = date('Y-m-d:h:i:s');
                if ($payment->save()) {
                    $contract_balance=$contract_balance-$model->amount_due;
                    ContractBalance::updateAll(['contract_outstanding'=>$contract_balance],['contract_ref_number'=>$model->contract_ref_number]);
                    CustomerBalance::updateAll(['current_balance'=>$newbalance],['customer_number'=>$model->customer_number]);
                    return $this->redirect(['site/index']);
                }
            }
        }
        else{
            Yii::$app->session->setFlash('danger', 'The customer has insufficient balance to make installment.');
            return $this->redirect(['site/index']);
        }

    }




    /**
     * Deletes an existing ContractAmountDue model.
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
     * Finds the ContractAmountDue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContractAmountDue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContractAmountDue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionExcel()

    {

        $searchModel = new ContractAmountDueSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderPartial('excel', [

            'searchModel' => $searchModel,

            'dataProvider' => $dataProvider,

        ]);

    }



}
