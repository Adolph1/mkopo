<?php

namespace backend\controllers;

use backend\models\AccdailyBal;
use backend\models\Audit;
use backend\models\SystemDate;
use Yii;
use backend\models\Account;
use backend\models\AccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\LoginForm;
/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller
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
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Account model.
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
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->isGuest) {
            $model = new Account();
            $model->maker_id = Yii::$app->user->identity->username;
            $model->maker_stamptime = SystemDate::getCurrentDate() . ' ' . date('H:i:s');
            $model->acc_open_date = SystemDate::getCurrentDate();
            $model->acc_status = 'O';
            $model->auth_stat = 'U';


            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                $dailyBalance = new AccdailyBal();
                $dailyBalance->branch_code = $model->branch_code;
                $dailyBalance->account = $model->cust_ac_no;
                $dailyBalance->available_balance = 0.00;
                $dailyBalance->value_date = SystemDate::getCurrentDate();
                $dailyBalance->Cedit_tur = 0.00;
                $dailyBalance->Debit_tur = 0.00;
                $dailyBalance->save();


                return $this->redirect(['view', 'id' => $model->cust_ac_no]);
            } else {
                return $this->render('create', [
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
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->isGuest) {

            $model = $this->findModel($id);
            $model->auth_stat = 'U';
            $model->checker_id='';
            $model->check_stamptime='';

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->cust_ac_no]);
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
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    //search customer Account

    public function actionSearch($id)
    {
        if(!Yii::$app->user->isGuest) {
            return $this->redirect(['view',
                'id' => $id,
            ]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }



    //Authorize Account

    public function actionApprove($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);

            $model->checker_id=Yii::$app->user->identity->username;
            $model->check_stamptime = SystemDate::getCurrentDate().' '.date('H:i:s');
            $model->auth_stat='A';
            $model->save();
            return $this->redirect(['view', 'id' => $model->cust_ac_no]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    //disables customer account

    public function actionDelete($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);
            $model->acc_status='D';
            $model->maker_id=Yii::$app->user->identity->username;
            $model->maker_stamptime=date('Y-m-d:H:i:s');
            $model->mod_no=$model->mod_no+1;
            if($model->save()){
                //saves logs
                Audit::setActivity('Customer maintenance','CD','Disable');

            }

            return $this->redirect(['view', 'id' => $model->cust_ac_no]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    //enables customer account
    public function actionEnable($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);
            $model->acc_status='O';
            $model->maker_id=Yii::$app->user->identity->username;
            $model->maker_stamptime=date('Y-m-d:H:i:s');
            $model->mod_no=$model->mod_no+1;
            if($model->save()){
                //saves logs
                Audit::setActivity('Customer account maintenance','CA','Enable');

            }


            return $this->redirect(['view', 'id' => $model->cust_ac_no]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }




    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
