<?php

namespace backend\controllers;

use backend\models\AccdailyBal;
use backend\models\Branch;
use backend\models\ContractAmountDue;
use backend\models\ContractAmountDueSearch;
use backend\models\ContractAmountRDDue;
use backend\models\ContractAmountReduceDue;
use backend\models\ContractAmountSearch;
use backend\models\ContractNormalRepayment;
use backend\models\ContractNormalRepaymentSearch;
use backend\models\ContractPayment;
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
            $payment=new ContractPayment();
            return $this->render('view', [
                'model' => $this->findModel($id),'payment'=>$payment
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
                $model->is_disbursed='N';
                $model->auth_stat = 'U';
                $model->maker_id = Yii::$app->user->identity->username;
                $model->maker_stamptime =SystemDate::getCurrentDate().' '.date('H:i:s');
                
                $guarantors = [new Guarantor()];


                //Calculating Flat rate

                if ($model->load(Yii::$app->request->post()) ) {
                    //checks minimum savings balance
                    $percentage = Product::getAllowedPercentage($_POST['ContractMaster']['product']);

                    if ($percentage != 0.00) {

                        $result = $this->calculatePercentage($percentage, $_POST['ContractMaster']['amount'], $_POST['ContractMaster']['settle_account']);
                        if ($result == true) {

                            $model->calculation_method = Product::getInterestMethod($_POST['ContractMaster']['product']);

                            if ($model->save()) {
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
                                if ($model->calculation_method == ContractMaster::FLAT_RATE) {
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



                                        //posts each payment date principal and interest

                                        if($model->payment_method==ContractMaster::MONTHLY) {

                                            $time = $model->frequency;
                                            $rate = $model->main_component_rate;
                                            $modelpaymentdate = $model->payment_date;
                                            $totalInterst = $this->getInterest($model->amount, $time, $rate / 100);
                                            $totalOutstanding = $model->amount + $totalInterst;
                                            $monthlyRepayment = $totalOutstanding / $time;
                                            $monthlyinterest = $this->getMonthlyInterest($model->amount, $rate / 100);
                                            $monthlyprincipal = $monthlyRepayment - $monthlyinterest;

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
                                        }elseif ($model->payment_method==ContractMaster::WEEKLY){
                                            $no_of_days=$this->calDays($model->maturity_date,$model->payment_date);
                                            //print_r($no_of_days);
                                            //exit;
                                            $time = $no_of_days/30;
                                            $rate = $model->main_component_rate;
                                            $modelpaymentdate = $model->payment_date;
                                            $totalInterst = $this->getInterest($model->amount, $time, $rate / 100);
                                            $totalOutstanding = $model->amount + $totalInterst;
                                            $weeklyRepayment = ($totalOutstanding / $time)*(7/30);
                                            $weeklyinterest = $this->getMonthlyInterest($model->amount, $rate / 100)*(7/30);
                                            $weeklyprincipal = $weeklyRepayment - $weeklyinterest;


                                            for ($i = 1; $i <= $no_of_days/7; $i++) {

                                                $duemodel = new ContractAmountDue();
                                                $duemodel->contract_ref_number = $model->contract_ref_no;
                                                $duemodel->component = 'PRINCIPAL';
                                                $duemodel->amount_due = $weeklyprincipal;
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
                                                $duemodel1->amount_due = $weeklyinterest;
                                                $duemodel1->status = 'A';

                                                $duemodel1->save();


                                                $week = $i . "weeks";
                                                $nextdate = date_create($modelpaymentdate);
                                                date_add($nextdate, date_interval_create_from_date_string($week));
                                                $nextdate = date_format($nextdate, 'Y-m-d');

                                                $model->payment_date = $nextdate;


                                            }
                                        }

                                        //saves contract balance
                                        $contractBalance = new ContractBalance();
                                        $contractBalance->contract_amount = $model->amount;
                                        $contractBalance->contract_outstanding = $model->amount + $totalInterst;
                                        $contractBalance->contract_ref_number = $model->contract_ref_no;
                                        $contractBalance->last_updated = SystemDate::getCurrentDate() . ' ' . date('H:i:s');
                                        $contractBalance->save();


                                    }
                                } elseif ($model->calculation_method == ContractMaster::REDUCING_BALANCE) {

                                    $rate = $model->main_component_rate / 1200;
                                    $monthlypayment = $this->calRDPayment($model->amount, $rate, $model->frequency);

                                    $interest = $model->amount * $rate;
                                    $principal = $monthlypayment - $interest;
                                    $balance = $model->amount - $principal;
                                    $contract_amount = $model->amount;


                                    for ($i = 1; $i <= $model->frequency; $i++) {


                                        $duemodel = new ContractAmountReduceDue();
                                        $duemodel->contract_ref_number = $model->contract_ref_no;
                                        $duemodel->monthly_payment = $monthlypayment;
                                        $duemodel->interest_amount_due = $interest;
                                        $duemodel->principal_amount_due = $principal;
                                        $duemodel->balance = $balance;
                                        $duemodel->interest_amount_settled = '0.00';
                                        $duemodel->principal_amount_settled = '0.00';
                                        $duemodel->account_due = $model->settle_account;

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
                                        $interest = $duemodel->balance * $rate;
                                        $principal = $monthlypayment - $interest;
                                        $balance = $duemodel->balance - $principal;
                                        $model->payment_date = $nextdate;


                                    }
                                    $contractbalance = new ContractBalance();
                                    $contractbalance->contract_ref_number = $model->contract_ref_no;
                                    $contractbalance->contract_amount = $contract_amount;
                                    $contractbalance->contract_outstanding = $monthlypayment * $model->frequency;
                                    $contractbalance->save();
                                }

                                $modelrefid = ReferenceIndex::getIDByRef($model->contract_ref_no);
                                ReferenceIndex::updateReference($modelrefid);

                                return $this->redirect(['view', 'id' => $model->contract_ref_no]);
                            }
                        } else {
                            Yii::$app->session->setFlash('danger', 'savings amount must be greater or equal to '.$percentage. '% of the loan amount');
                            return $this->render('create', [
                                'guarantors' => (empty($guarantors)) ? [new Guarantor()] : $guarantors, 'model' => $model
                            ]);
                        }
                    }else{
                        Yii::$app->session->setFlash('warning', 'Please set the minimum allowed savings percentage for the loan product.');
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
            $model->checker_id=Yii::$app->user->identity->username;
            $model->checker_stamptime=SystemDate::getCurrentDate().' '.date('H:i:s');
            $model->auth_stat='A';

            if($model->save()){
                $role_events=ProductAccrole::getRoleEvents($model->product,$event=EventType::INIT);
                if($role_events!=null) {
                    foreach ($role_events as $role_event) {
                        if ($role_event->dr_cr_indicator == 'C') {


                            //saves customer leg
                            TodayEntry::saveEntry(
                                $module = 'LD',
                                $model->contract_ref_no,
                                SystemDate::getCurrentDate(),
                                $model->settle_account,
                                Customer::getBranchByCustomerNo($model->customer_number),
                                $model->amount,
                                $ind = 'C',
                                $model->customer_number,
                                $model->product,
                                SystemDate::getCurrentDate(),
                                $event
                            );

                            //updates customer account balance

                            AccdailyBal::updateAccountBalance($model->settle_account, $model->amount, 'C');


                        } elseif ($role_event->dr_cr_indicator == 'D') {

                            //saves GL leg
                            TodayEntry::saveEntry(
                                $module = 'LD',
                                $model->contract_ref_no,
                                SystemDate::getCurrentDate(),
                                $role_event->mis_head,
                                Customer::getBranchByCustomerNo($model->customer_number),
                                $model->amount,
                                $ind = 'D',
                                $model->customer_number,
                                $model->product,
                                SystemDate::getCurrentDate(),
                                $event
                            );


                            //updates GL balance

                            GlDailyBalance::updateGLBalance($role_event->mis_head, $model->amount, 'D');


                        }
                    }
                }
                TodayEntry::updateAll(['auth_stat'=>'A','checker_id'=>$model->checker_id,'checker_time'=>$model->checker_stamptime],['trn_ref_no'=>$model->contract_ref_no,'auth_stat'=>'U']);
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

    public function actionDisburse($id)
    {
        if(!Yii::$app->user->isGuest) {
            $model = $this->findModel($id);
            $model->is_disbursed = 'Y';
            if ($model->save()) {



                $role_events=ProductAccrole::getRoleEvents($model->product,$event=EventType::LDS);
                if($role_events!=null) {
                    foreach ($role_events as $role_event) {
                        if ($role_event->dr_cr_indicator == 'D') {


                            //saves customer leg
                            TodayEntry::saveEntry(
                                $module = 'LD',
                                $model->contract_ref_no,
                                SystemDate::getCurrentDate(),
                                $model->settle_account,
                                Customer::getBranchByCustomerNo($model->customer_number),
                                $model->amount,
                                $ind = 'D',
                                $model->customer_number,
                                $model->product,
                                SystemDate::getCurrentDate(),
                                $event
                            );

                            //updates customer account balance

                            AccdailyBal::updateAccountBalance($model->settle_account, $model->amount, 'D');


                        } elseif ($role_event->dr_cr_indicator == 'C') {

                            //saves GL leg

                            TodayEntry::saveEntry(
                                $module = 'LD',
                                $model->contract_ref_no,
                                SystemDate::getCurrentDate(),
                                $role_event->mis_head,
                                Customer::getBranchByCustomerNo($model->customer_number),
                                $model->amount,
                                $ind = 'C',
                                $model->customer_number,
                                $model->product,
                                SystemDate::getCurrentDate(),
                                $event
                            );


                            //updates GL balance

                            GlDailyBalance::updateGLBalance($role_event->mis_head, $model->amount, 'C');


                        }
                    }
                }
                TodayEntry::updateAll(['auth_stat'=>'A','checker_id'=>Yii::$app->user->identity->username,'checker_time'=>SystemDate::getCurrentDate() . ' ' . date('H:i:s')],['trn_ref_no'=>$model->contract_ref_no,'auth_stat'=>'U']);

                $payment = new ContractPayment();
                $payment->trn_dt = SystemDate::getCurrentDate();
                $payment->contract_ref_number = $model->contract_ref_no;
                $payment->debit = $model->amount;
                $payment->credit = 0.00;
                $payment->transaction_type = 1;
                $payment->balance = $payment->debit - $payment->credit;
                $payment->maker_id = Yii::$app->user->identity->username;
                $payment->maker_time = SystemDate::getCurrentDate() . ' ' . date('H:i:s');
                $payment->save();


                return $this->redirect(['view', 'id' => $model->contract_ref_no]);
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

    public function actionWriteOff($id)
    {
        if(!Yii::$app->user->isGuest){
            $model=$this->findModel($id);
            $model->contract_status='WF';
            $model->save();
            return $this->redirect(['view', 'id' => $model->contract_ref_no]);
        }
        else{
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }


    }


    public function actionWriteOn($id)
    {
        if(!Yii::$app->user->isGuest){
            $model=$this->findModel($id);
            $model->contract_status='A';
            $model->save();
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



    public  function  calculatePercentage($percentage,$amount,$saving_account)
    {
      $accbal=AccdailyBal::getBalance($saving_account);

      $percentageamount=($percentage/100)*$amount;
      if($accbal->available_balance>=$percentageamount){
          return true;
      }else{
          return false;
      }



    }


    public function findSystemRate()
    {
     if (($sysrate = SystemSetup::findOne(1)) !== null) {
        return $sysrate;
    } else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    }



    /**---------------------------------------------------------------------------
     * Loans Reports methods
     * ---------------------------------------------------------------------------
     * */

public function actionCustomerLoanReport($id)
{
    $loans=$this->loadLoans($id);
    if($loans!=null){

        echo '<table class="table table-condensed">';
        echo '<tr><th>Booking Date</th><th>Reference</th><th>Customer</th><th>Amount</th><th>Outstanding</th><th>Maturity</th><th>Status</th></tr>';
        $totalamt=0.00;
        $totalout=0.00;
        foreach ($loans as $loan){
            echo '<tr>';
            echo '<td>'.$loan->booking_date.'</td>';
            echo '<td>'.$loan->contract_ref_no.'</td>';
            echo '<td>'.$loan->customer_number.'</td>';
            echo '<td>'.$loan->amount.'</td>';
            echo '<td>'.ContractBalance::getOutstanding($loan->contract_ref_no).'</td>';
            echo '<td>'.$loan->maturity_date.'</td>';
            echo '<td>'.$loan->contract_status.'</td>';
            echo '</tr>';
            $totalamt=$totalamt+$loan->amount;
            $totalout=$totalout+ContractBalance::getOutstanding($loan->contract_ref_no);
        }
        echo '<tr>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<th>Total</th>';
        echo '<th>'.$totalamt.'</th>';
        echo '<th>'.$totalout.'</th>';
        echo '<td></td>';
        echo '<td></td>';
       echo '</tr>';
        echo '</table>';
    }else{
        echo '<table class="table table-condensed">';
        echo '<tr><th>Booking Date</th><th>Reference</th><th>Customer</th><th>Amount</th><th>Outstanding</th><th>Maturity</th><th>Status</th></tr>';
        echo 'No result found';
        echo '</table>';
    }
}


public function loadLoans($customer_no)
{
    $loans=ContractMaster::find()->where(['customer_number'=>$customer_no])->andWhere(['!=','auth_stat','U'])->all();
    if($loans!=null){
        return $loans;
    }else{
        return null;
    }
}


}
