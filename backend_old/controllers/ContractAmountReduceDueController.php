<?php

namespace backend\controllers;

use backend\models\Customer;
use Yii;
use backend\models\ContractAmountReduceDue;
use backend\models\ContractAmountReduceDueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\LoginForm;

/**
 * ContractAmountReduceDueController implements the CRUD actions for ContractAmountReduceDue model.
 */
class ContractAmountReduceDueController extends Controller
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
     * Lists all ContractAmountReduceDue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContractAmountReduceDueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionAwaiting()
    {
        if(!Yii::$app->user->isGuest) {
            $searchModel = new ContractAmountReduceDueSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('awaitingRepayment', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }

    }

    public function actionFilterUnpaid()
    {
        if(!Yii::$app->user->isGuest) {
            $parent = $this->findModelUnpaid();
            if ($parent != null) {
                foreach ($parent as $par) {
                    echo Customer::getCustPhoneNumber($par->customer_number) . ',' . Customer::getFullNameByCustomerNumber($par->customer_number) . ',' . $par->due_date . ',' . $par->monthly_payment . ';';
                }
            }
        } else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    /**
     * Displays a single ContractAmountReduceDue model.
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
     * Creates a new ContractAmountReduceDue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContractAmountReduceDue();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }



    /**
     * Updates an existing ContractAmountReduceDue model.
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
     * Deletes an existing ContractAmountReduceDue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetRepay($id)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $result=$this->findModel($id);

        if(count($result) > 0 )

        {

            return array('status' => true, 'data'=> $result);

        }

        else

        {

            return array('status'=>false,'data'=> 'No record Found');

        }
    }

    /**
     * Finds the ContractAmountReduceDue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContractAmountReduceDue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContractAmountReduceDue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelUnpaid()
    {
        $pending=ContractAmountReduceDue::find()->where(['status'=>'A'])->andWhere(['<=','due_date',date('Y-m-d')])->all();
        if($pending!=null){
            return $pending;
        }else{
            return 0;
        }
    }

}
