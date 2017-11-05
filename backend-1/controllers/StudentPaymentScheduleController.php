<?php

namespace backend\controllers;

use backend\models\Student;
use Yii;
use backend\models\StudentPaymentSchedule;
use backend\models\StudentPaymentScheduleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentPaymentScheduleController implements the CRUD actions for StudentPaymentSchedule model.
 */
class StudentPaymentScheduleController extends Controller
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
     * Lists all StudentPaymentSchedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentPaymentScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StudentPaymentSchedule model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionGetStudentPayment($id,$payid)
    {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $studentpayment = StudentPaymentSchedule::find()->Where(['student_reg'=>$id,'payment_type_id'=>$payid])->one();
        $student = Student::find()->where(['reg_no'=>$id])->one();

        if(count($student) > 0 )

        {
            if($studentpayment->amount==0.00){

                return array('status'=>true,'datainfo'=> 'Already paid');

            }else {

                return array('status' => true, 'data' => $studentpayment, 'data1' => $student);
            }

        }

        else

        {

            return array('status'=>false,'data'=> 'No Student payment Found');

        }

    }


    /**
     * Creates a new StudentPaymentSchedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentPaymentSchedule();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StudentPaymentSchedule model.
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
     * Deletes an existing StudentPaymentSchedule model.
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
     * Finds the StudentPaymentSchedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StudentPaymentSchedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentPaymentSchedule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
