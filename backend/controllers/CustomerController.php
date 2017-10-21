<?php

namespace backend\controllers;

use backend\models\Audit;
use backend\models\CustomerBalance;
use backend\models\Teller;
use Yii;
use backend\models\Customer;
use backend\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\LoginForm;

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
        if(!Yii::$app->user->isGuest) {
            $searchModel = new CustomerSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
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
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!Yii::$app->user->isGuest) {

         $customer=$this->findModel($id);
         $transactions=Teller::getAllTransactions($customer->customer_no);

        return $this->render('view', [
            'model' => $this->findModel($id),'transactions'=>$transactions
        ]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    public function actionGetCustomer($id)

    {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $student = Customer::find()->where(['customer_no'=>$id])->one();

        if(count($student) > 0 )

        {

            return array('status' => true, 'data'=> $student);

        }

        else

        {

            return array('status'=>false,'data'=> 'No Customer Found');

        }

    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!Yii::$app->user->isGuest) {
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
                    if($model->save()){
                        $cust_balance=new CustomerBalance();
                        $cust_balance->customer_number=$model->customer_no;
                        $cust_balance->opening_balance=0;
                        $cust_balance->current_balance=0;
                        $cust_balance->last_updated=date('Y-m-d:H:i:s');
                        $cust_balance->save();
                        return $this->redirect(['view', 'id' => $model->id]);

                    }

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
                    if($model->save()){
                        $cust_balance=new CustomerBalance();
                        $cust_balance->customer_number=$model->customer_no;
                        $cust_balance->opening_balance=0;
                        $cust_balance->current_balance=0;
                        $cust_balance->last_updated=date('Y-m-d:H:i:s');
                        $cust_balance->save();
                        return $this->redirect(['view', 'id' => $model->id]);

                    }
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
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
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
        if(!Yii::$app->user->isGuest) {
        $model = $this->findModel($id);
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');
        $model->mod_no=$model->mod_no+1;

        if ($model->load(Yii::$app->request->post())) {
            if(UploadedFile::getInstance($model, 'customer_photo')) {
                $model->photo = UploadedFile::getInstance($model, 'customer_photo');

                if ($model->photo != null) {
                    $model->photo->saveAs('uploads/' . $model->customer_no . '.' . $model->photo->extension);
                    $model->photo = $model->customer_no . '.' . $model->photo->extension;
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            else {


                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
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
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->isGuest) {
        $model=$this->findModel($id);
        $model->record_stat='D';
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');
        $model->mod_no=$model->mod_no+1;
            if($model->save()){
                //saves logs
                Audit::setActivity('Customer maintenance','CD','Disable');

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

    //enables customer
    public function actionEnable($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);
            $model->record_stat='O';
            $model->maker_id=Yii::$app->user->identity->username;
            $model->maker_time=date('Y-m-d:H:i:s');
            $model->mod_no=$model->mod_no+1;
           if($model->save()){
               //saves logs
               Audit::setActivity('Customer maintenance','CD','Enable');

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

    //search customer

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

    //Search customer for new account creation
    public function actionSearchCustomer($id)
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;

        $customer = Customer::find()->where(['id'=>$id])->one();

        if(count($customer) > 0 )

        {

            return array('status' => true, 'data'=> $customer);

        }

        else

        {

            return array('status'=>false,'data'=> 'No Customer Found');

        }

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
