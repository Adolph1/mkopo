<?php

namespace backend\controllers;

use Yii;
use backend\models\Customer;
use backend\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
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
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');
        $model->customer_no=$this->findLast();
        $model->mod_no=1;
        $model->record_stat='O';

        if ($model->load(Yii::$app->request->post())) {
            $model->photo = UploadedFile::getInstance($model, 'customer_photo');
            if ($model->photo != null) {
                $model->photo->saveAs('uploads/' . $model->customer_no . '.' . $model->photo->extension);
                $model->photo = $model->customer_no . '.' . $model->photo->extension;
                $date1=$_POST['Customer']['expire_date'];
                $date2=date('Y-m-d');
                $diff = strtotime($date2) - strtotime($date1);
                if($diff<0) {
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }  else{
                    Yii::$app->session->setFlash('danger', 'Your identification has expired. ');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }

            } else {
                $date1=$_POST['Customer']['expire_date'];
                $date2=date('Y-m-d');
                $diff = strtotime($date2) - strtotime($date1);
                if($diff<0) {
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }  else{
                    Yii::$app->session->setFlash('danger', 'Your identification has expired. ');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }
        }else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');
        $model->mod_no=$model->mod_no+1;

        if ($model->load(Yii::$app->request->post())) {
            $model->photo = UploadedFile::getInstance($model, 'customer_photo');
            if ($model->photo != null) {
                $model->photo->saveAs('uploads/' . $model->customer_no . '.' . $model->photo->extension);
                $model->photo = $model->customer_no . '.' . $model->photo->extension;

                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->record_stat='D';
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');
        $model->mod_no=$model->mod_no+1;
        $model->save();

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findLast()
    {

        $model = Customer::find()->orderBy('id DESC')->one();

        if ($model != null) {
            $model->customer_no =sprintf("%04d", $model->customer_no + 1);
            return $model->customer_no;
        }
        else {

            $model = new Customer();
            $model->customer_no = '0001';
            return $model->customer_no;

        }

    }
}
