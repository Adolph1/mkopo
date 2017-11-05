<?php

namespace backend\controllers;

use backend\models\StudentPaymentSchedule;
use Yii;
use backend\models\BankTransaction;
use backend\models\BankTransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BankTransactionController implements the CRUD actions for BankTransaction model.
 */
class BankTransactionController extends Controller
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
     * Lists all BankTransaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BankTransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BankTransaction model.
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
     * Creates a new BankTransaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BankTransaction();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BankTransaction model.
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


    public function actionCreateStudentPayment($bankref,$stdid,$amount,$trndt,$ptype,$bank)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $model = new BankTransaction();

        $model->scenario = BankTransaction:: SCENARIO_CREATE;
        $model->student_reg_no=$stdid;
        $model->source_ref_no=$bankref;
        $model->amount=$amount;
        $model->trn_dt=$trndt;
        $model->payment_type=$ptype;
        $model->bank_name=$bank;
        //$model->attributes = \yii::$app->request->post();


        //$model->save();

        if($model->save())

        {


            $updatebalance=StudentPaymentSchedule::updateBalance($model->student_reg_no,$model->payment_type,$model->amount);
            if($updatebalance) {
                return array('status' => true, 'data' => 'Student record is successfully updated');
            }

        }

        else

        {

            return array('status'=>false,'data'=>$model->getErrors());

        }

    }

    /**
     * Deletes an existing BankTransaction model.
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
     * Finds the BankTransaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BankTransaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BankTransaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
