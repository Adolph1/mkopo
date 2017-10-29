<?php

namespace backend\controllers;

use backend\models\ContractAmountDue;
use backend\models\ContractAmountDueSearch;
use backend\models\ContractAmountRDDue;
use backend\models\ContractAmountReduceDue;
use backend\models\ContractAmountSearch;
use backend\models\ContractNormalRepayment;
use backend\models\ContractNormalRepaymentSearch;
use backend\models\Customer;
use backend\models\CustomerBalance;
use backend\models\GlDailyBalance;
use backend\models\Guarantor;
use backend\models\ProductAccrole;
use backend\models\ProductEventEntry;
use backend\models\SystemCharges;
use backend\models\SystemDate;
use backend\models\SystemSetup;
use backend\models\Teller;
use backend\models\TodayEntry;
use backend\models\EventType;
use backend\models\GeneralLedger;
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
use backend\models\Model;
use common\models\LoginForm;

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
    { if (!Yii::$app->user->isGuest) {
        $searchModel = new ContractMasterSearch();
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
     * Displays a single ContractMaster model.
     * @param string $id
     * @return mixed
     */
 
    //Searching contract and displaying its schedule
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
            $loanSchedule=new ContractAmountReduceDue();
            return $this->render('view', [
                'model' => $this->findModel($id),'loanSchedule'=>$loanSchedule
            ]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }

    //view schedule
    public function actionSchedule($id)
    {
        if (!Yii::$app->user->isGuest) {
        return $this->render('schedule', [
            'model' => $this->findModel($id),
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
     * Creates a new ContractMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if (!Yii::$app->user->isGuest) {
            if (yii::$app->User->can('createContract')) {
                $model = new ContractMaster();
                $model->module = 'LD';
                $model->contract_status = 'A';
                $model->auth_stat = 'U';
                $model->maker_id = Yii::$app->user->identity->username;
                $model->maker_stamptime =SystemDate::getCurrentDate().' '.date('H:i:s');
                
                $guarantors = [new Guarantor()];


                //Calculating Flat rate

                if ($model->load(Yii::$app->request->post()) ) {
                    $model->calculation_method=Product::getInterestMethod($_POST['ContractMaster']['product']);

                        //saves to today's transactions
                        //gets accounting roles and events
                        $role_events=ProductAccrole::getRoleEvents($produtcode=$model->product,$event=EventType::INIT);
                        if($role_events!=null){
                        foreach($role_events as $role_event){
                            if($role_event->dr_cr_indicator=='C'){
                                TodayEntry::saveEntry($module = 'LD', $model->contract_ref_no, SystemDate::getCurrentDate(), $model->customer_number, Customer::getBranchByCustomerNo($model->customer_number), $model->amount, $ind = 'C', $model->customer_number, $model->product,$model->value_date);
                            }elseif($role_event->dr_cr_indicator=='D'){
                                TodayEntry::saveEntry($module = 'LD', $model->contract_ref_no, SystemDate::getCurrentDate(), $role_event->mis_head, Customer::getBranchByCustomerNo($model->customer_number), $model->amount, $ind = 'D', $model->customer_number, $model->product, $model->value_date);
                                
                                //saves gl entry
                                $gl=$this->findGLBalance($role_event->mis_head);
                                if($gl!=null){
                                $gl_balance=new GlDailyBalance();
                                $gl_balance->trn_date=SystemDate::getCurrentDate();
                                $gl_balance->gl_code=$role_event->mis_head;
                                $gl_balance->opening_balance=$model->amount;
                                $gl_balance->dr_turn=$gl->dr_turn+$model->amount;
                                $gl_balance->cr_turn=0.00;
                                $gl_balance->closing_balance= $gl_balance->dr_turn-$gl_balance->cr_turn;
                                $gl_balance->save();
                                //updates Gl real Balance
                                GeneralLedger::updateAll(['balance'=>$gl_balance->closing_balance],['gl_code'=>$role_event->mis_head]);
                                //updates Gl real Balance
                                GeneralLedger::updateAll(['balance'=>$gl_balance->closing_balance],['gl_code'=>$role_event->mis_head]);
                                }else{
                                $gl_balance=new GlDailyBalance();
                                $gl_balance->trn_date=SystemDate::getCurrentDate();
                                $gl_balance->gl_code=$role_event->mis_head;
                                $gl_balance->opening_balance=$model->amount;
                                $gl_balance->dr_turn=$model->amount;
                                $gl_balance->cr_turn=0.00;
                                $gl_balance->closing_balance= $gl_balance->dr_turn-$gl_balance->cr_turn;
                                $gl_balance->save();
                                //updates Gl real Balance
                                GeneralLedger::updateAll(['balance'=>$gl_balance->closing_balance],['gl_code'=>$role_event->mis_head]);
                                }
                            }
                            }
                     if($model->save()){
                    //saves gurantors
                    $guarantors = Model::createMultiple(Guarantor::classname());
                    Model::loadMultiple($guarantors, Yii::$app->request->post());
                    // print_r($model);
                    //exit;

                    // validate all models
                    $valid = $model->validate();
                    $valid = Model::validateMultiple($guarantors) && $valid;


                    if ($valid) {


                        $transaction = \Yii::$app->db->beginTransaction();
                        //print_r($transaction);
                        //exit;
                        try {


                            foreach ($guarantors as $guarantor) {


                                $guarantor->contract_ref_number = $model->contract_ref_no;
                                $guarantor->related_customer = $model->customer_number;
                                $guarantor->maker_id = Yii::$app->user->identity->username;
                                $guarantor->maker_time = date('Y-m-d:H:i:s');

                                if (!($flag = $guarantor->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                } else {
                                    //$this->updateTotal($subitem->id,$subitem->qty,$subitem->price);
                                }
                            }

                            $transaction->commit();
                            //return $this->redirect(['view', 'id' => $model->id]);
                        } catch (Exception $e) {
                            $transaction->rollBack();
                        }

                    }


                    //calculate repayment schedule
                  if($model->calculation_method==ContractMaster::FLAT_RATE) {
                      if ($model->frequency == 0) {
                          $time = 1;
                          $rate = $model->main_component_rate;
                          $totalRepay = $this->getInterest($model->amount, $time, $rate / 100);

                          //for one month

                          $duemodel = new ContractAmountDue();
                          $duemodel->contract_ref_number = $model->contract_ref_no;
                          $duemodel->component = 'PRINCIPAL';
                          $duemodel->amount_due = $model->amount;
                          $duemodel->currency_amt_due = 'TZS';
                          $duemodel->account_due = $model->customer_number;
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

                          $duemodel->save();


                          $duemodel1 = new ContractAmountDue();
                          $duemodel1->contract_ref_number = $model->contract_ref_no;
                          $duemodel1->currency_amt_due = 'TZS';
                          $duemodel1->account_due = $model->customer_number;
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
                          $duemodel1->component = 'INTEREST';
                          $duemodel1->amount_due = $totalRepay;
                          $duemodel1->status = 'A';

                          $duemodel1->save();
                          $contractBalance = new ContractBalance();
                          $contractBalance->contract_amount = $model->amount;
                          $contractBalance->contract_outstanding = $model->amount + $totalRepay;
                          $contractBalance->contract_ref_number = $model->contract_ref_no;
                          $contractBalance->last_updated = date('Y-m-d H:i:s');
                          $contractBalance->save();


                      } else {
                          $time = $model->frequency;
                          $rate = $model->main_component_rate;
                          $modelpaymentdate = $model->payment_date;
                          $totalInterst = $this->getInterest($model->amount, $time, $rate / 100);
                          $totalOutstanding = $model->amount + $totalInterst;
                          $monthlyRepayment = $totalOutstanding / $time;
                          $monthlyinterest = $this->getMonthlyInterest($model->amount, $rate / 100);
                          $monthlyprincipal = $monthlyRepayment - $monthlyinterest;


                          //posts each payment date principal and interest
                          for ($i = 1; $i <= $model->frequency; $i++) {


                              $duemodel = new ContractAmountDue();
                              $duemodel->contract_ref_number = $model->contract_ref_no;
                              $duemodel->component = 'PRINCIPAL';
                              $duemodel->amount_due = $monthlyprincipal;
                              $duemodel->currency_amt_due = 'TZS';
                              $duemodel->account_due = $model->customer_number;
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
                              $duemodel->save();


                              $duemodel1 = new ContractAmountDue();
                              $duemodel1->contract_ref_number = $model->contract_ref_no;
                              $duemodel1->currency_amt_due = 'TZS';
                              $duemodel1->account_due = $model->customer_number;
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
                              $duemodel1->component = 'INTEREST';
                              $duemodel1->amount_due = $monthlyinterest;
                              $duemodel1->status = 'A';

                              $duemodel1->save();
                              $month = $i . "months";
                              $nextdate = date_create($modelpaymentdate);
                              date_add($nextdate, date_interval_create_from_date_string($month));
                              $nextdate = date_format($nextdate, 'Y-m-d');

                              $model->payment_date = $nextdate;


                          }

                          //saves contract balance
                          $contractBalance = new ContractBalance();
                          $contractBalance->contract_amount = $model->amount;
                          $contractBalance->contract_outstanding = $model->amount + $totalInterst;
                          $contractBalance->contract_ref_number = $model->contract_ref_no;
                          $contractBalance->last_updated = SystemDate::getCurrentDate() . ' ' . date('H:i:s');
                          $contractBalance->save();



                      }
                  }elseif($model->calculation_method==ContractMaster::REDUCING_BALANCE){

                      $rate = $model->main_component_rate / 1200;
                      $monthlypayment = $this->calRDPayment($model->amount, $rate, $model->frequency);

                      $interest = $model->amount*$rate;
                      $principal = $monthlypayment - $interest;
                      $balance=$model->amount-$principal;



                      for ($i = 1; $i <= $model->frequency; $i++) {


                          $duemodel = new ContractAmountReduceDue();
                          $duemodel->contract_ref_number = $model->contract_ref_no;
                          $duemodel->monthly_payment = $monthlypayment;
                          $duemodel->interest_amount_due = $interest;
                          $duemodel->principal_amount_due = $principal;
                          $duemodel->balance=$balance;
                          $duemodel->interest_amount_settled = '0.00';
                          $duemodel->principal_amount_settled = '0.00';
                          $duemodel->account_due = $model->customer_number;

                          $duemodel->customer_number = $model->customer_number;
                          $duemodel->inflow_outflow = 'O';
                          $duemodel->basis_amount_tag = '';
                          $duemodel->adjusted_amount = '0';
                          $duemodel->scheduled_linkage = '';
                          $duemodel->amount_prepaid = '0';
                          $duemodel->due_date = $model->payment_date;
                          $duemodel->original_due_date = $model->payment_date;
                          $duemodel->status = 'A';
                          $duemodel->save();

                          //increment month by i
                          $month = $i . "months";
                          $nextdate = date_create($model->payment_date);
                          date_add($nextdate, date_interval_create_from_date_string($month));
                          $nextdate = date_format($nextdate, 'Y-m-d');

                          $model->amount = $duemodel->balance;
                          $rate = $model->main_component_rate / 1200;
                          $interest=$duemodel->balance*$rate;
                          $principal = $monthlypayment - $interest;
                          $balance=$duemodel->balance-$principal;
                          $model->payment_date = $nextdate;


                      }
                      $contractbalance = new ContractBalance();
                      $contractbalance->contract_ref_number = $model->contract_ref_no;
                      $contractbalance->contract_amount = $model->amount;
                      $contractbalance->contract_outstanding = $monthlypayment*$model->frequency;
                      $contractbalance->save();
                  }

                    $modelrefid = ReferenceIndex::getIDByRef($model->contract_ref_no);
                    ReferenceIndex::updateReference($modelrefid);

                    return $this->redirect(['view', 'id' => $model->contract_ref_no]);
                }
                } else {
                    return $this->render('create', [
                        'guarantors' => (empty($guarantors)) ? [new Guarantor()] : $guarantors, 'model' => $model
                    ]);
                }
            }
              else{

                  return $this->render('create', [
                        'guarantors' => (empty($guarantors)) ? [new Guarantor()] : $guarantors, 'model' => $model
                    ]);
                        }
        }          
            else{
                Yii::$app->session->setFlash('danger', 'You dont have permission to create loan contract.');
                return $this->redirect(['index']);
            }
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }



    }

    public function actionApprove($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model=$this->findModel($id);
            $balance=CustomerBalance::getBalance($model->customer_number);
            if($balance!=0.00) {
                $newbalance=$balance+$model->amount;
                CustomerBalance::updateAll(['current_balance' => $newbalance], ['customer_number' => $model->customer_number]);
            }
            else{
                $customerbalance=new CustomerBalance();
                $customerbalance->customer_number=$model->customer_number;
                $customerbalance->current_balance=$model->amount;
                $customerbalance->opening_balance=$model->amount;
                $customerbalance->last_updated=SystemDate::getCurrentDate().' '.date('H:i:s');
                $customerbalance->save();
            }
            $model->checker_id=Yii::$app->user->identity->username;
            $model->checker_stamptime=SystemDate::getCurrentDate().' '.date('H:i:s');
            $model->auth_stat='A';

            if($model->save()){
                TodayEntry::updateAll(['auth_stat'=>'A'],['trn_ref_no'=>$model->contract_ref_no]);
            }
            return $this->redirect(['view', 'id' => $model->contract_ref_no]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
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

//viewpayment function
   public function actionPayment($id)
    {
        if(!Yii::$app->user->isGuest){
        return $this->render('payment', [
            'model' => $this->findModel($id),
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
     * Deletes an existing ContractMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(!Yii::$app->user->isGuest) {
            if (yii::$app->User->can('createContract')) {
                $model=$this->findModel($id);
                $model->contract_status='D';
                if($model->save()){
                    ContractAmountDue::updateAll(['status'=>'D'],['contract_ref_number'=>$id]);
                }

                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('danger', 'You dont have permission to delete loan.');
                return $this->redirect(['index']);
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

      protected function findGLBalance($id)
    {

            if (($model = GlDailyBalance::find()->where(['gl_code'=>$id])->orderBy('id DESC')->one()) !== null) {
                return $model;
            } else {
                return null;
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
                $end_date = SystemDate::getCurrentDate();
                $end_date=date('y-m-d',strtotime($end_date));
                $thedate = explode("-", $end_date);
                $year = $thedate[0];
                $month = $thedate[1];
                $day = $thedate[2];
                $model = new ReferenceIndex();
                $model->index_no = sprintf("%04d", 0001);
                $model->product = $id;
                $model->full_reference =  $id .$year.$month.$day.$model->index_no;
                $model->status = 'N';
                $model->save();
                echo $model->full_reference;

            }

    }

    public function actionCalcmaturitydate($paymentdate,$frequency)
    {
        $date = date_create($paymentdate);
        if($frequency<=1){
            $frequency=0;
            $month=$frequency."months";
            date_add($date, date_interval_create_from_date_string($month));
        }else {
            $frequency = $frequency - 1;
            $month = $frequency . "months";
            date_add($date, date_interval_create_from_date_string($month));
        }
        echo date_format($date, 'Y-m-d');

    }

    //for one month
    public function actionCalcmaturitydate1($paymentdate)
    {
        $date = $paymentdate;

        echo $date;

    }

//Full period interest
    public function getInterest($p,$t,$r)
    {

        $Interest = ($p * $r * $t);
        return $Interest;
    }
    //Monthly interest
    public function getMonthlyInterest($p,$r)
    {

        $monthlyInterest = ($p * $r);
        return $monthlyInterest;
    }

    //Monthly principal
    public function getMonthlyPrincipal($mpay,$mi)
    {

        $monthlyPrincipal = $mpay-$mi;
        return number_format($monthlyPrincipal, 2,'.', '');
    }


    public function getRDInterest($p,$t,$r)
    {

        $I = ($p * $r * $t);
        return number_format($I, 2,'.', '');
    }


    public function calRDPayment($p,$r,$n)
    {

        $term=$n;
        $part1 = pow((1+$r), $term);
        $part2 = $p * $r * $part1;
        $part3 = $part1 - 1;
        $emi =(100 * ($part2 / $part3)) / 100;

        return number_format($emi, 2, '.', '');
    }


//Total Outstanding
    public function getTotalOutstanding($fp,$fi)
    {

        $TotalOutstanding = $fp + $fi;
        return number_format($TotalOutstanding, 2,'.', '');
    }



    public  function  calDays($date2,$date1)
    {
        $diff = strtotime($date2) - strtotime($date1);
        $days = $diff / 60 / 60 / 24;
        return $days;

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
