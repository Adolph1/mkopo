<?php

namespace backend\controllers;

use backend\models\ContractAmountDue;
use backend\models\ContractAmountDueSearch;
use backend\models\ContractAmountSearch;
use backend\models\ContractNormalRepayment;
use backend\models\ContractNormalRepaymentSearch;
use backend\models\SystemCharges;
use backend\models\SystemSetup;
use Yii;
use backend\models\ContractMaster;
use backend\models\Product;
use backend\models\Account;
use backend\models\ReferenceIndex;
use backend\models\ContractMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ContractBalance;
use backend\models\ContractAmount;

/**
 * ContractMasterController implements the CRUD actions for ContractMaster model.
 */
class ContractMasterController extends Controller
{
    public $gridColumns;
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
     * Lists all ContractMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContractMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContractMaster model.
     * @param string $id
     * @return mixed
     */
 
    //Searching contract and dispalying its schedule
    public function actionView($id)
    {   $model = $this->findModel($id);
        $normalpay = $this->findNormalDueDate($id);
        $modelbal=$this->findModelbalance($model->contract_ref_no);
        //print_r($modelbal->contract_ref_number);
        //die;
        $modeldue= new ContractAmountDue();
        $searchdues = new ContractAmountDueSearch();
        $datadues = $searchdues->searchdue($model->contract_ref_no);
        $datadues->pagination->pageSize=100;

        $modeldue1= new ContractAmount();
        $searchdues1 = new ContractAmountSearch();
        $datadues1 = $searchdues1->searchdue1($model->contract_ref_no);
        $datadues1->pagination->pageSize=100;

        if($normalpay!=='liquidated') {
            return $this->render('view', [
                'model' => $this->findModel($id), 'modeldue' => $modeldue, 'searchdues' => $searchdues,
                'datadues' => $datadues, 'normalpay' => $normalpay, 'modelbal' => $modelbal, 'modeldue1' => $modeldue1, 'searchdues1' => $searchdues1, 'datadues1' => $datadues1
            ]);
        }
        else
        {
            return $this->render('view', [
                'model' => $this->findModel($id), 'modeldue' => $modeldue, 'searchdues' => $searchdues,
                'datadues' => $datadues, 'normalpay' => $normalpay, 'modelbal' => $modelbal, 'modeldue1' => $modeldue1, 'searchdues1' => $searchdues1, 'datadues1' => $datadues1
            ]);
        }
    }

    /**
     * Creates a new ContractMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContractMaster();
        $model->module='LD';
        $model->contract_status='Active';
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_stamptime=date('Y-m-d:H:s');
        $model->branch='000';
        $model->settle_account='000';



            //Calculating Flat rate

            if ($model->load(Yii::$app->request->post()) && $model->save()) {






                $time = $model->frequency;

                $rate = $model->main_component_rate / 100;

                $modelpaymentdate = $model->payment_date;

                $modelinterest = $this->getInterest($model->amount, $time, $rate);
                $modeloutstanding = $this->getTotalOutstanding($model->amount, $modelinterest);
                $modelpayment = $this->getMonthlyPayment($modeloutstanding, $time);
                $modelmonthlyinterest = $this->getMonthlyInterest($model->amount, $rate);
                $modelmonthlyprincipal = $this->getMonthlyPrincipal($modelpayment, $modelmonthlyinterest);

                for ($i = 1; $i <= $model->frequency; $i++) {


                    $duemodel = new ContractAmountDue();
                    $duemodel->contract_ref_number = $model->contract_ref_no;
                    $duemodel->component = 'Principal';
                    $duemodel->amount_due = $modelmonthlyprincipal;
                    $duemodel->currency_amt_due = 'TZS';
                    $duemodel->account_due = $model->settle_account;
                    $duemodel->amount_settled = '0';
                    $duemodel->customer_number = $model->customer_number;
                    $duemodel->inflow_outflow = 'O';
                    $duemodel->basis_amount_tag = '';
                    $duemodel->adjusted_amount = '0';
                    $duemodel->scheduled_linkage = '';
                    $duemodel->component_type = 'P';
                    $duemodel->amount_prepaid = '0';
                    $duemodel->due_date = $model->payment_date;
                    $duemodel->original_due_date = $model->payment_date;
                    $duemodel->status = 'A';
                    //print_r($duemodel);
                    $duemodel->save();


                    $duemodel1 = new ContractAmountDue();
                    $duemodel1->contract_ref_number = $model->contract_ref_no;
                    $duemodel1->currency_amt_due = 'TZS';
                    $duemodel1->account_due = $model->settle_account;
                    $duemodel1->amount_settled = '0';
                    $duemodel1->customer_number = $model->customer_number;
                    $duemodel1->inflow_outflow = 'O';
                    $duemodel1->basis_amount_tag = '';
                    $duemodel1->adjusted_amount = '0';
                    $duemodel1->scheduled_linkage = '';
                    $duemodel1->component_type = 'I';
                    $duemodel1->amount_prepaid = '0';
                    $duemodel1->due_date = $model->payment_date;
                    $duemodel1->original_due_date = $model->payment_date;
                    $duemodel1->component = 'TSAL-INT';
                    $duemodel1->amount_due = $modelmonthlyinterest;
                    $duemodel1->status = 'A';

                    $duemodel1->save();
                    //increment month by i
                    $month = $i . "months";
                    $nextdate = date_create($modelpaymentdate);
                    date_add($nextdate, date_interval_create_from_date_string($month));
                    $nextdate = date_format($nextdate, 'Y-m-d');

                    $model->payment_date = $nextdate;


                    /*$contractamount = new ContractAmount();
                    $contractamount->contract_ref_number = $model->contract_ref_no;
                    $contractamount->amount_due = $modelpayment;
                    $contractamount->due_date = $duemodel->due_date;
                    $contractamount->account_due = $duemodel->account_due;
                    $contractamount->customer_number = $duemodel->customer_number;
                    $contractamount->amount_settled = $duemodel->amount_settled;
                    $contractamount->status = 'A';
                    $contractamount->save();*/


                }

                /*$contractbalance = new ContractBalance();
                $contractbalance->contract_ref_number = $model->contract_ref_no;
                $contractbalance->contract_amount = $model->amount;
                $contractbalance->contract_outstanding = $modeloutstanding;
                $contractbalance->save();
                */

                $modelrefid=ReferenceIndex::getIDByRef($model->contract_ref_no);
                ReferenceIndex::updateReference($modelrefid);

                return $this->redirect(['view', 'id' => $model->contract_ref_no]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }



    }

    /**
     * Updates an existing ContractMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->contract_ref_no]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

//payment function
   public function actionPayment($id)
    {
        $duemodel= new ContractAmountDue();
        $duedate = $this->findDueDate($id);
        if($duedate) {
            return $this->render('payment', [
                'duemodel' => $duemodel, 'id' => $id, 'duedate' => $duedate,
            ]);
        }
        else
        {
            return $this->redirect(['view', 'id' => $id]);
        }
    }
    public function actionNormalpayment($id)
    {
        if(yii::$app->User->can('liquidateContract')) {
            $model = $this->findModel($id);
            $modelbal = $this->findModelbalance($model->contract_ref_no);
            $duemodel = new ContractNormalRepayment();
            $normalpay = $this->findNormalDueDate($id);
            $rate = $this->getRate($id);
            $rate2 = $rate;
            $rate = $rate->main_component_rate / 100;
            $normalpay1 = $this->findPaynow($normalpay->id);
            $modeldue = new ContractNormalRepayment();
            $searchdues = new ContractNormalRepaymentSearch();
            $datadues = $searchdues->searchdue($model->contract_ref_no);
            $datadues->pagination->pageSize = 100;


            if ($normalpay->load(Yii::$app->request->post())) {
                $normalpay1->customer_installment = $_POST['ContractNormalRepayment']['customer_installment'];
                if ($normalpay1->customer_installment == $normalpay->full_oustanding) {
                    $paymentdate = $rate2->payment_date;

                    $days = $this->calDays($paymentdate, date('Y-m-d'));
                    if ($days > 14) {
                        $normalpay1->status = 'L';
                        $normalpay1->balance = '0';
                        $normalpay1->maker_id = Yii::$app->user->identity->username;
                        $normalpay1->maker_time = date('Y-m-d:H:i');
                        $normalpay1->save();
                        $sql = 'update tbl_contract_normal_repayment set status="L" where contract_ref_number="' . $id . '" ';
                        \Yii::$app->db->createCommand($sql)->execute();
                        $model->contract_status = 'Liquidated';
                        $model->save();
                    } else {
                        $systecharge = $this->getSystemcharge(2);
                        $systecharge2 = $systecharge->charge;
                        $systecharge = ($systecharge->charge) / 100;

                        $prepaidinterest = $this->getInterest($normalpay1->contract_amount, $rate2->frequency, $systecharge);
                        $prepaidamount = $prepaidinterest + $normalpay1->contract_amount;
                        $normalpay1->status = 'L';
                        $normalpay1->balance = '0';
                        $normalpay1->pre_liquidation = $prepaidamount;
                        $normalpay1->pre_liquidation_rate = $systecharge2;
                        $normalpay1->maker_id = Yii::$app->user->identity->username;
                        $normalpay1->maker_time = date('Y-m-d:H:i');
                        $normalpay1->save();
                        $sql = 'update tbl_contract_normal_repayment set status="L" where contract_ref_number="' . $id . '" ';
                        \Yii::$app->db->createCommand($sql)->execute();
                        $model->contract_status = 'Liquidated';
                        $model->save();

                    }

                } 
                 if ($normalpay1->customer_installment > $normalpay->full_oustanding) {

                    Yii::$app->session->setFlash('danger', 'Installment Amount can not be greater than total oustanding.');

                 }

                else {
                    if (($normalpay1->customer_installment) >= ($normalpay->expected_installment)) {
                        $countexecess = floor($normalpay1->customer_installment / $normalpay->expected_installment);
                        $newnormapay = $normalpay->month_factor;
                        if ($countexecess == 1) {
                            $normalpay1->status = 'L';
                            $normalpay1->maker_id = Yii::$app->user->identity->username;
                            $normalpay1->maker_time = date('Y-m-d:H:i');
                            $normalpay1->balance = $normalpay->contract_outstanding - $normalpay1->customer_installment;
                            $normalpay1->save();

                            $normalpay->month_factor = $normalpay->month_factor - 1;

                            $currentperiod_outstanding = $this->getInterest($normalpay1->balance, $normalpay->month_factor, $rate);
                            $currentperiod_outstanding = $normalpay1->balance + $currentperiod_outstanding;

                            $modelmonthlyinterest = $this->getMonthlyInterest($normalpay1->balance, $rate);
                            $nextpay = $this->findNormalDueDate($id);
                            $nextpay1 = $this->findPaynow($nextpay->id);
                            $modelpayment = $modelmonthlyinterest + $normalpay1->balance;
                            $modelpayment = $this->getMonthlyPayment($modelpayment, $normalpay->month_factor);
                            $nextpay1->full_oustanding = $currentperiod_outstanding;
                            $nextpay1->contract_amount = $normalpay1->balance;
                            $nextpay1->interest = $modelmonthlyinterest;
                            $nextpay1->contract_outstanding = $modelmonthlyinterest + $normalpay1->balance;
                            $nextpay1->balance = $nextpay1->contract_outstanding;
                            $nextpay1->expected_installment = $modelpayment;
                            $nextpay1->maker_id = Yii::$app->user->identity->username;
                            $nextpay1->maker_time = date('Y-m-d:H:i');
                            $nextpay1->save();


                        } elseif ($countexecess > 1) {
                            $newcustomerinstallment = $normalpay1->customer_installment - $normalpay->expected_installment;
                            $normalpay1->customer_installment = $normalpay->expected_installment;
                            $normalpay1->status = 'L';
                            $normalpay1->maker_id = Yii::$app->user->identity->username;
                            $normalpay1->maker_time = date('Y-m-d:H:i');
                            $normalpay1->balance = $normalpay->contract_outstanding - $normalpay1->customer_installment;
                            $normalpay1->save();

                            $normalpay->month_factor = $normalpay->month_factor - 1;
                            $currentperiod_outstanding = $this->getInterest($normalpay1->balance, $normalpay->month_factor, $rate);
                            $currentperiod_outstanding = $normalpay1->balance + $currentperiod_outstanding;


                            $modelmonthlyinterest = $this->getMonthlyInterest($normalpay1->balance, $rate);
                            $nextpay = $this->findNormalDueDate($id);
                            $nextpay1 = $this->findPaynow($nextpay->id);
                            $modelpayment = $modelmonthlyinterest + $normalpay1->balance;
                            $modelpayment = $this->getMonthlyPayment($modelpayment, $normalpay->month_factor);
                            $nextpay1->full_oustanding = $currentperiod_outstanding;
                            $nextpay1->contract_amount = $normalpay1->balance;
                            $nextpay1->interest = $modelmonthlyinterest;
                            $nextpay1->customer_installment = $newcustomerinstallment;
                            $nextpay1->contract_outstanding = $modelmonthlyinterest + $normalpay1->balance;
                            $nextpay1->balance = $nextpay1->contract_outstanding - $nextpay1->customer_installment;
                            $nextpay1->expected_installment = $modelpayment;
                            $nextpay1->status = 'L';
                            $nextpay1->maker_id = Yii::$app->user->identity->username;
                            $nextpay1->maker_time = date('Y-m-d:H:i');
                            $nextpay1->save();
                            for ($i = 1; $i <= $countexecess - 2; $i++) {
                                $nextpayexcess = $this->findNormalDueDate($id);
                                $nextpayexcess1 = $this->findPaynow($nextpayexcess->id);
                                $nextpayexcess1->status = 'L';
                                $nextpayexcess1->maker_id = Yii::$app->user->identity->username;
                                $nextpayexcess1->maker_time = date('Y-m-d:H:i');

                                //$normalpay1->balance = $normalpay->contract_outstanding - $normalpay1->customer_installment;
                                $nextpayexcess1->save();

                            }
                            $nextpay->month_factor = $newnormapay - ($countexecess);
                            $currentperiod_interest = $this->getInterest($nextpay1->balance, $nextpay->month_factor, $rate);
                            $currentperiod_outstanding = $nextpay1->balance + $currentperiod_interest;
                            $modelmonthlyinterest = $this->getMonthlyInterest($nextpay1->balance, $rate);
                            $lastpay = $this->findNormalDueDate($id);
                            $lasttpay1 = $this->findPaynow($lastpay->id);


                            $modelpayment = $modelmonthlyinterest + $nextpay1->balance;
                            $modelpayment = $this->getMonthlyPayment($modelpayment, $nextpay->month_factor);
                            $lasttpay1->full_oustanding = $currentperiod_outstanding;
                            $lasttpay1->contract_amount = $nextpay1->balance;
                            $lasttpay1->interest = $modelmonthlyinterest;
                            $lasttpay1->contract_outstanding = $modelmonthlyinterest + $lasttpay1->contract_amount;
                            $lasttpay1->balance = $lasttpay1->contract_outstanding;
                            $lasttpay1->expected_installment = $modelpayment;
                            $lasttpay1->maker_id = Yii::$app->user->identity->username;
                            $lasttpay1->maker_time = date('Y-m-d:H:i');
                            $lasttpay1->save();

                        }
                    }
                }

                return $this->render('view', [
                    'model' => $this->findModel($id), 'duemodel' => $duemodel, 'modelbal' => $modelbal, 'datadues' => $datadues, 'modeldue' => $modeldue, 'searchdues' => $searchdues, 'id' => $id, 'normalpay' => $normalpay,
                ]);
            } else {
                return $this->render('normalpayment', [
                    'model' => $this->findModel($id), 'duemodel' => $duemodel, 'modelbal' => $modelbal, 'datadues' => $datadues, 'modeldue' => $modeldue, 'searchdues' => $searchdues, 'id' => $id, 'normalpay' => $normalpay,
                ]);
            }
        }
        else
        {
            Yii::$app->session->setFlash('danger', 'You dont have permission to liquidate loan.');
            return $this->redirect(['index']);
        }

    }







    /**
     * Deletes an existing ContractMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(yii::$app->User->can('createContract')) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        }
        else
        {
            Yii::$app->session->setFlash('danger', 'You dont have permission to delete loan.');
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the ContractMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ContractMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {

            if (($model = ContractMaster::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }

    }

    public function findPaynow($id)
    {
        if (($model = ContractNormalRepayment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function getSystemcharge($id)
    {
        if (($model = SystemCharges::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function getRate($id)
    {
        if (($model = ContractMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function findModelbalance($refno)
    {
        $cb = ContractBalance::find()
        ->where(['contract_ref_number' => $refno])
        ->orderBy('contract_ref_number DESC')
        ->One();
        if($cb) {
            return $cb;
        }
        else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }


    }
    public function findDueDate($refno)
    {
        $dd = ContractAmount::find()
            ->where(['contract_ref_number' => $refno,'status'=>'A'])
            ->orderBy('contract_ref_number DESC')
            ->One();
        if($dd) {
            return $dd;
        }
        else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }


}

    public function findNormalDueDate($refno)
    {
        $dd = ContractNormalRepayment::find()
            ->where(['contract_ref_number' => $refno,'status'=>'A'])
            ->orderBy('contract_ref_number DESC')
            ->One();
        if($dd) {
            return $dd;
        }
        else {
            return 'liquidated';
            //throw new NotFoundHttpException('The requested page does not exist.');
        }


    }
    public function findInterestPaid($refno,$duedate)
    {
        $dd = ContractAmountDue::find()
            ->where(['contract_ref_number' => $refno,'component_type'=>'I','due_date'=>$duedate])
            ->orderBy('contract_ref_number DESC')
            ->One();
        if($dd) {
            return $dd;
        }
        else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }


    }
    public function findPrincipalPaid($refno,$duedate)
{
    $dd = ContractAmountDue::find()
        ->where(['contract_ref_number' => $refno,'component_type'=>'P','due_date'=>$duedate])
        ->orderBy('contract_ref_number DESC')
        ->One();
    if($dd) {
        return $dd;
    }
    else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
    public function findAmountPaid($refno,$duedate)
    {
        $dd = ContractAmount::find()
            ->where(['contract_ref_number' => $refno,'due_date'=>$duedate])
            ->orderBy('contract_ref_number DESC')
            ->One();
        if($dd) {
            return $dd;
        }
        else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }


    }
    public function actionList($id)
{
    $countPosts = Account::find()
        ->where(['cust_no' => $id])
        ->count();

    $posts = Account::find()
        ->where(['cust_no' => $id])
        ->orderBy('cust_no DESC')
        ->all();

    if($countPosts>0){
        foreach($posts as $post){
            echo "<option value='".$post->cust_ac_no."'>".$post->cust_ac_no."</option>";
        }
    }
    else{
        echo "<option> </option>";
    }

}
    public function actionProductgroup($id)
{
    $countProducts = Product::find()
        ->where(['product_id' => $id])
        ->count();

    $products = Product::find()
        ->where(['product_id' => $id])
        ->orderBy('product_id DESC')
        ->all();

    if($countProducts>0){
        foreach($products as $product){
            echo $product->product_group;
        }
    }
    else{
        echo "";
    }

}
   public function actionReference($id)
    {
        $reference = ReferenceIndex::find()
            ->where(['product' => $id,'status'=>'N'])
            ->one();

        if ($reference!=null) {
                    echo $reference->full_reference;


        }
        else {

                $model = new ReferenceIndex();
                $model->index_no = sprintf("%04d", 0001);
                $model->product = $id;
                $model->full_reference = $id . date('y').date('m').date('d').$model->index_no;
                $model->status = 'N';
                $model->save();
                echo $model->full_reference;

            }

    }

    public function actionCalcmaturitydate($frequency,$paymentdate)
    {
        $date = date_create($paymentdate);
        $month=$frequency."months";
        date_add($date, date_interval_create_from_date_string($month));

        /*
        for($i=0;$i<$frequency;$i++) {
            $month = $i . "months";
            $date2 =$paymentdate . " + " . $month;
            $date2 = strtotime(date('Y-m-d', $date2));
        }
        */
        echo date_format($date, 'Y-m-d');

    }

//Full period interest
    public function getInterest($p,$t,$r)
    {

        $Interest = ($p * $r * $t);
        return number_format($Interest, 2,'.', '');
    }
    //Monthly interest
    public function getMonthlyInterest($p,$r)
    {

        $monthlyInterest = ($p * $r);
        return number_format($monthlyInterest, 2,'.', '');
    }

    //Monthly principal
    public function getMonthlyPrincipal($mpay,$mi)
    {

        $monthlyPrincipal = $mpay-$mi;
        return number_format($monthlyPrincipal, 2,'.', '');
    }


//Total Outstanding
    public function getTotalOutstanding($fp,$fi)
    {

        $TotalOutstanding = $fp + $fi;
        return number_format($TotalOutstanding, 2,'.', '');
    }
//Monthly Payment
    public function getMonthlyPayment($TO,$TP)
    {

        $MonthlyPayment = $TO/$TP;
        return number_format($MonthlyPayment, 2,'.', '');
    }





    public  function  calDays($date2,$date1)
    {
        //$date2= date_create($date2);
        //$month=1;
        //$month=$month."months";
        //date_add($date2, date_interval_create_from_date_string($month));
        //$date2=date_format($date2, 'Y-m-d');
        $diff = strtotime($date2) - strtotime($date1);
        $days = $diff / 60 / 60 / 24;
        return $days;

    }
    public function getInterest1($p,$t,$r)
    {

        $I = ($p * $r * $t);
        return number_format($I, 2,'.', '');
    }


    public function calPayment1($p,$r,$n,$t)
    {

        $py=($r*$p) / ($n *( 1 -  pow( (1 + ($r/$n)), (-$n*$t))));

        return number_format($py, 2, '.', '');
    }

    public function findSystemRate()
    {
     if (($sysrate = SystemSetup::findOne(1)) !== null) {
        return $sysrate;
    } else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    }




}
