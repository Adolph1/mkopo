<?php

namespace backend\controllers;

use Yii;
use backend\models\ContractAmountDue;
use backend\models\ContractAmountDueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
