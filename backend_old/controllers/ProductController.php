<?php

namespace backend\controllers;

use backend\models\Audit;
use backend\models\SystemDate;
use Yii;
use backend\models\Product;
use backend\models\ProductSearch;
use backend\models\ProductAccroleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ProductAccrole;
use backend\models\ProductEventEntry;
use backend\models\ProductEventEntrySearch;
use yii\helpers\ArrayHelper;
use kartik\grid\EditableColumnAction;
use common\models\LoginForm;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionTellerindex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tellerindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionLoanindex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('loanindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDepositindex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('depositindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {   if(!Yii::$app->user->isGuest) {
        $model = $this->findModel($id);
        $modelaccrole= new ProductAccrole();
        $modelevent= new ProductEventEntry();
        $searchroles = new ProductAccroleSearch();
        $searchevents = new ProductEventEntrySearch();
        $dataRoles = $searchroles->searchrole($model->product_id);
        $dataEvents = $searchevents->searchevent($model->product_id);


        return $this->render('view', [
            'model' => $this->findModel($id),'modelaccrole'=>$modelaccrole,'searchroles' => $searchroles,
            'dataRoles' => $dataRoles,'searchevents' => $searchevents,'dataEvents' => $dataEvents,'modelevent' => $modelevent,
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->isGuest) {
            $model = new Product();
            $model->auth_stat = 'U';
            $model->maker_id=Yii::$app->user->identity->username;
            $model->maker_stamptime=SystemDate::getCurrentDate().' '.date('H:i:s');
            $model->record_stat = 'O';

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->product_id]);
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
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->isGuest) {
        $model = $this->findModel($id);
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_stamptime=SystemDate::getCurrentDate().' '.date('H:i:s');
        $model->auth_stat='U';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->product_id]);
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
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model = $this->findModel($id);
            $model->maker_id=Yii::$app->user->identity->username;
            $model->maker_stamptime=SystemDate::getCurrentDate().' '.date('H:i:s');
            $model->record_stat = 'D';
            $model->save();
            return $this->redirect(['view','id'=>$model->product_id]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    //search product

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

    //enables product
    public function actionEnable($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);
            $model->record_stat='O';
            $model->maker_id=Yii::$app->user->identity->username;
            $model->maker_stamptime=SystemDate::getCurrentDate().' '.date('H:i:s');
            $model->auth_stat='U';
            if($model->save()){
                //saves logs
                Audit::setActivity('Product maintenance','PD','Enable');

            }


            return $this->redirect(['view', 'id' => $model->product_id]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    //approves product
    public function actionApprove($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);
            $model->record_stat='O';
            $model->checker_id=Yii::$app->user->identity->username;
            $model->checker_stamptime=SystemDate::getCurrentDate().' '.date('H:i:s');
            $model->auth_stat='A';
            if($model->save()){
                //saves logs
                Audit::setActivity('Product maintenance','PD','Enable');

            }


            return $this->redirect(['view', 'id' => $model->product_id]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
