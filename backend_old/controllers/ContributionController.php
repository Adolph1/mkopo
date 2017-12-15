<?php

namespace backend\controllers;

use backend\models\AccdailyBal;
use backend\models\Account;
use backend\models\Customer;
use backend\models\EventType;
use backend\models\GlDailyBalance;
use backend\models\ProductAccrole;
use backend\models\ReferenceIndex;
use backend\models\SystemDate;
use backend\models\TodayEntry;
use Yii;
use backend\models\Contribution;
use backend\models\ContributionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\LoginForm;

/**
 * ContributionController implements the CRUD actions for Contribution model.
 */
class ContributionController extends Controller
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
     * Lists all Contribution models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContributionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contribution model.
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
     * Creates a new Contribution model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->isGuest) {
            $model = new Contribution();
            $model->trn_dt=SystemDate::getCurrentDate();
            $model->maker_id=Yii::$app->user->identity->username;
            $model->maker_time==SystemDate::getCurrentDate() . ' ' . date('H:i:s');
            $model->auth_stat='U';

            if ($model->load(Yii::$app->request->post())) {
                if ($model->save()) {
                    //fetches,updates and generate reference
                    $modelrefid = ReferenceIndex::getIDByRef($model->trn_ref_no);
                    ReferenceIndex::updateReference($modelrefid);

                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('danger', 'Transaction not saved');
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
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }



    //approves contribution transaction

    public function actionApprove($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);

            $model->checker_id=Yii::$app->user->identity->username;
            $model->checker_time = SystemDate::getCurrentDate().' '.date('H:i:s');
            $model->auth_stat='A';
            //$model->save();
            if($model->save()){
                $role_events=ProductAccrole::getRoleEvents($model->product,$event=EventType::INIT);
                if($role_events!=null) {
                    foreach ($role_events as $role_event) {
                        if ($role_event->dr_cr_indicator == 'C') {


                            //saves customer leg
                            TodayEntry::saveEntry(
                                $module = 'MD',
                                $model->trn_ref_no,
                                SystemDate::getCurrentDate(),
                                Account::getAccount($model->customer_number),
                                Customer::getBranchByCustomerNo($model->customer_number),
                                $model->amount,
                                $ind = 'C',
                                $model->customer_number,
                                $model->product,
                                SystemDate::getCurrentDate(),
                                $event
                            );

                            //updates customer account balance

                            AccdailyBal::updateAccountBalance(Account::getAccount($model->customer_number), $model->amount, 'C');


                        } elseif ($role_event->dr_cr_indicator == 'D') {

                            //saves GL leg
                            TodayEntry::saveEntry(
                                $module = 'MD',
                                $model->trn_ref_no,
                                SystemDate::getCurrentDate(),
                                $role_event->mis_head,
                                Customer::getBranchByCustomerNo($model->customer_number),
                                $model->amount,
                                $ind = 'D',
                                $model->customer_number,
                                $model->product,
                                SystemDate::getCurrentDate(),
                                $event
                            );


                            //updates GL balance

                            GlDailyBalance::updateGLBalance($role_event->mis_head, $model->amount, 'D');


                        }
                    }
                }
                TodayEntry::updateAll(['auth_stat'=>'A','checker_id'=>$model->checker_id,'checker_time'=>$model->checker_time],['trn_ref_no'=>$model->trn_ref_no,'auth_stat'=>'U']);
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
     * Updates an existing Contribution model.
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
     * Deletes an existing Contribution model.
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
     * Finds the Contribution model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contribution the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contribution::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
