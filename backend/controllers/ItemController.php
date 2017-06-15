<?php

namespace backend\controllers;

use backend\models\Shelve;
use backend\models\SubItem;
use backend\models\Model;
use Yii;
use backend\models\Item;
use backend\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
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
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionAdvancesearch()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('advanced_search_results', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Item model.
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
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new Item();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    public function actionCreate()
    {
        $model = new Item();
        $subitems = [new SubItem()];
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');
        $model->status='0';



        if ($model->load(Yii::$app->request->post())) {
            $shelve = Shelve::getEmptySpace($_POST['Item']['location_id']);
            if ($shelve != null) {
                $model->shelve_id = $shelve->id;

                $countusage = Item::find()->where(['shelve_id' => $shelve->id])->count();
                // print_r($shelve->balance);
                // exit;

                if ($countusage == 0) {
                    $model->item_reference = $shelve->title . '-1';
                } elseif ($countusage < $shelve->balance) {
                    $model->item_reference = $shelve->title . '-' . ($countusage + 1);
                    $newbalance=$shelve->balance-1;
                    //print_r($shelve->title.($countusage+1));
                    //exit;
                }
                if($model->item_reference!=null) {
                    $model->save();
                    if($newbalance!=null){
                        Shelve::updateAll(['balance'=>$newbalance],['id'=>$model->shelve_id]);
                    }
                }
                $subitems = Model::createMultiple(SubItem::classname());
                Model::loadMultiple($subitems, Yii::$app->request->post());
                // print_r($model);
                //exit;

                // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($subitems) && $valid;


                if ($valid) {


                    $transaction = \Yii::$app->db->beginTransaction();
                    //print_r($transaction);
                    //exit;
                    try {


                        foreach ($subitems as $subitem) {


                            $subitem->item_id = $model->id;
                            $subitem->maker_id = Yii::$app->user->identity->username;
                            $subitem->maker_time = date('Y-m-d:H:i:s');

                            if (!($flag = $subitem->save(false))) {
                                $transaction->rollBack();
                                break;
                            } else {
                                //$this->updateTotal($subitem->id,$subitem->qty,$subitem->price);
                            }
                        }

                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }

                }
            }
            else
            {

                Yii::$app->session->setFlash('warning', 'shelves are not yet configured to this '.$model->location->location_name. ' location');
                return $this->render('create', [
                    'subitems' => (empty($subitems)) ? [new SubItem()] : $subitems, 'model' => $model
                ]);
            }
        }
        else {


            return $this->render('create', [
                'subitems' => (empty($subitems)) ? [new SubItem()] : $subitems, 'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Item model.
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
     * Deletes an existing Item model.
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
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
