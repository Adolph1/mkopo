<?php

namespace backend\controllers;

use backend\models\EventType;
use backend\models\GlDailyBalance;
use backend\models\ReferenceIndex;
use backend\models\SystemDate;
use backend\models\TodayEntry;
use Yii;
use backend\models\JournalEntry;
use backend\models\JournalEntrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\LoginForm;

/**
 * JournalEntryController implements the CRUD actions for JournalEntry model.
 */
class JournalEntryController extends Controller
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
     * Lists all JournalEntry models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest) {
            $searchModel = new JournalEntrySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $model = new JournalEntry();
            $model->auth_stat = 'U';

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                $modelrefid = ReferenceIndex::getIDByRef($model->trn_ref_no);
                ReferenceIndex::updateReference($modelrefid);
                return $this->redirect(['reload']);
            } else {
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider, 'model' => $model,
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

    public function actionReload()
    {
        return $this->redirect(['index']);
    }

    /**
     * Displays a single JournalEntry model.
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
     * Creates a new JournalEntry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JournalEntry();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionApprove($id)
    {
        if(!Yii::$app->user->isGuest) {
            //saves GL credit leg
            $model = $this->findModel($id);
            $model->auth_stat = 'A';
            $model->checker_id = Yii::$app->user->identity->username;
            $model->checker_time = SystemDate::getCurrentDate() . ' ' . date('H:i:s');
            TodayEntry::saveEntry(
                $module = 'DE',
                $model->trn_ref_no,
                SystemDate::getCurrentDate(),
                $model->credit_account,
                '000',
                $model->amount,
                $ind = 'C',
                $model->credit_account,
                'JRN',
                SystemDate::getCurrentDate(),
                EventType::JN_BY
            );

            GlDailyBalance::updateGLBalance($model->credit_account, $model->amount, 'C');


            //saves debit GL leg
            TodayEntry::saveEntry(
                $module = 'DE',
                $model->trn_ref_no,
                SystemDate::getCurrentDate(),
                $model->debit_account,
                '000',
                $model->amount,
                $ind = 'D',
                $model->debit_account,
                'JRN',
                SystemDate::getCurrentDate(),
                EventType::JN_TO
            );


            //updates GL balance

            GlDailyBalance::updateGLBalance($model->debit_account, $model->amount, 'D');
            $model->save();

            TodayEntry::updateAll(['auth_stat' => 'A', 'checker_id' => $model->checker_id, 'checker_time' => $model->checker_time], ['trn_ref_no' => $model->trn_ref_no, 'auth_stat' => 'U']);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing JournalEntry model.
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
     * Deletes an existing JournalEntry model.
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
     * Finds the JournalEntry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JournalEntry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JournalEntry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
