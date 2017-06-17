<?php

namespace backend\controllers;

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
    {   $model = $this->findModel($id);
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

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->product_id]);
        } else {
            return $this->render('create', [
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->product_id]);
        } else {
            return $this->render('update', [
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'editcart' => [                                       // identifier for your editable action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => Product::className(),             // the update model class
                'outputValue' => function ($model, $attribute, $key, $index) {
                    $fmt = Yii::$app->formatter;
                    $value = $model->$attribute;                 // your attribute value
                    if ($attribute === 'price') // selective validation by attribute
                    { $updateTotal=$this->findModel($model->id);
                        $updateTotal->total=$updateTotal->qty*$updateTotal->price;
                        $updateTotal->save();
                        $this->redirect(['sales/create']);
                        return $fmt->asDecimal($value, 2);       // return formatted value if desired


                    } elseif ($attribute === 'qty') {   // selective validation by attribute
                        $inventory=Inventory::find()->where(['product_id'=>$model->product_id])->one();
                        if($inventory->qty<$model->qty)
                        {
                            $updateQty=$this->findModel($model->id);
                            $updateQty->qty=$inventory->qty;
                            $updateQty->total=$updateQty->qty*$updateQty->price;
                            $updateQty->save();
                        }
                        else{
                            $updateTotal=$this->findModel($model->id);
                            $updateTotal->total=$updateTotal->qty*$updateTotal->price;
                            $updateTotal->save();
                            // $this->redirect(['sales/create']);
                            return $fmt->asDecimal($value, 2); // return formatted value if desired

                        }



                    }
                    return '';                                   // empty is same as $value
                },
                'outputMessage' => function($model, $attribute, $key, $index) {
                    return '';                                  // any custom error after model save
                },
                // 'showModelErrors' => true,                     // show model errors after save
                // 'errorOptions' => ['header' => '']             // error summary HTML options
                // 'postOnly' => true,
                // 'ajaxOnly' => true,
                // 'findModel' => function($id, $action) {},
                // 'checkAccess' => function($action, $model) {}
            ]
        ]);

    }

}
