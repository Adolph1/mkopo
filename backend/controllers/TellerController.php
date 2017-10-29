<?php

namespace backend\controllers;

use backend\models\Account;
use backend\models\Branch;
use backend\models\Customer;
use backend\models\CustomerBalance;
use backend\models\SystemDate;
use backend\models\TodayEntry;
use Yii;
use backend\models\Teller;
use backend\models\TellerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ReferenceIndex;
use common\models\LoginForm;
/**
 * TellerController implements the CRUD actions for Teller model.
 */
class TellerController extends Controller
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
     * Lists all Teller models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest) {
            $searchModel = new TellerSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else{
                $model = new LoginForm();
                return $this->redirect(['site/login',
                    'model' => $model,
                ]);
            }
    }

    /**
     * Displays a single Teller model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!Yii::$app->user->isGuest) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Teller model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->isGuest) {
            if(yii::$app->User->can('LoanOfficer')) {


                $model = new Teller();
                $model->status = 'U';
                $model->trn_dt = SystemDate::getCurrentDate();
                $model->maker_id = Yii::$app->user->identity->username;
                $model->maker_time = SystemDate::getCurrentDate().' '.date('H:i:s');


                if ($model->load(Yii::$app->request->post())) {
                    $customer_no=Account::getCustomerNumberByAccount($_POST['Teller']['txn_account']);
                    if($customer_no!=null) {
                        $model->related_customer = $customer_no;
                        // saves today's transactions
                        if ($model->save()) {
                            TodayEntry::saveEntry($module = 'DE', $model->reference, $model->trn_dt, $model->txn_account, Customer::getBranchByCustomerNo($model->related_customer), $model->amount, $ind = 'C', $model->related_customer, $model->product, $value = date('Y-m-d'));
                            TodayEntry::saveEntry($module = 'DE', $model->reference, $model->trn_dt, $model->offset_account, Customer::getBranchByCustomerNo($model->related_customer), $model->amount, $ind = 'D', $model->related_customer, $model->product, $value = date('Y-m-d'));

                            //fetches,updates and generate reference
                            $modelrefid = ReferenceIndex::getIDByRef($model->reference);
                            ReferenceIndex::updateReference($modelrefid);

                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            Yii::$app->session->setFlash('danger', 'Transaction not saved');
                            return $this->render('create', [
                                'model' => $model,
                            ]);
                        }
                    }
                    else{
                        Yii::$app->session->setFlash('danger', 'Wrong account details');
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
                } else {
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }
            else{
                Yii::$app->session->setFlash('danger', 'You dont have permission to post teller transaction');
                return $this->redirect(['index']);
            }
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Teller model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->isGuest) {
        $model = $this->findModel($id);
        $model->maker_id=Yii::$app->user->identity->username;
       $model->status='U';
        $model->maker_time=date('Y-m-d:H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Teller model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->isGuest) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionReverse($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);
            $custbalance=CustomerBalance::getBalance($model->related_customer);
            $newbalance=$custbalance+$model->amount;
            if(CustomerBalance::updateAll(['current_balance'=>$newbalance],['customer_number'=>$model->related_customer])) {
                $model->status = 'R';
                $model->maker_id = Yii::$app->user->identity->username;
                $model->maker_time = SystemDate::getCurrentDate().' '.date('H:i:s');

                if($model->save()){
                    TodayEntry::updateAll(['auth_stat'=>'R'],['trn_ref_no'=>$model->reference]);
                }
            }
            //$this->findModel($id)->delete();

            return $this->redirect(['teller/view','id'=>$id]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    public function actionApprove($id)
    {
        if(!Yii::$app->user->isGuest) {
        $model=$this->findModel($id);

        //gets current balance
        $balance=CustomerBalance::getBalance($model->related_customer);
        if($balance!=null) {
            $newbalance=$balance+$model->amount;
            CustomerBalance::updateAll(['current_balance' => $newbalance], ['customer_number' => $model->related_customer]);
        }
        else{
            $customerbalance=new CustomerBalance();
            $customerbalance->customer_number=$model->related_customer;
            $customerbalance->current_balance=$model->amount;
            $customerbalance->opening_balance=$model->amount;
            $customerbalance->last_updated=date('Y-m-d');
            $customerbalance->save();
        }
        $model->checker_id=Yii::$app->user->identity->username;
        $model->checker_time = SystemDate::getCurrentDate().' '.date('H:i:s');
        $model->status='A';
        //$model->save();
        if($model->save()){
           TodayEntry::updateAll(['auth_stat'=>'A'],['trn_ref_no'=>$model->reference]);
        }
        return $this->redirect(['view', 'id' => $model->id]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Teller model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teller the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teller::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
