<?php

namespace console\controllers;

use backend\models\ContractAmountDue;
use backend\models\ContractBalance;
use backend\models\Eod;
use backend\models\EodCycle;
use backend\models\MaturedLoanCharge;
use backend\models\ReferenceIndex;
use backend\models\SystemDate;
use backend\models\SystemSetup;
use backend\models\SystemStage;
use backend\models\TodayEntry;
use Yii;
use yii\console\Controller;
use backend\models\ContractMaster;


/**
 * BGEmailController implements the CRUD actions for BGEmail model.
 */
class EodController extends Controller
{


    public function findUnauthorised()
    {
        $unauthorised = TodayEntry::getUnauthorised();

        if ($unauthorised > 0) {

            return 'There are unauthorised transactions in eod cycle';


        } elseif ($unauthorised == 0) {

            return null;

        }


    }

    public function changeDate()
    {


        ReferenceIndex::deleteAll();
        SystemDate::updateAll(['previous_working_day' => SystemDate::getCurrentDate(), 'current_working_day' => date('Y-m-d', strtotime(SystemDate::getCurrentDate() . "+1 days")), 'next_working_day' => date('Y-m-d', strtotime(SystemDate::getCurrentDate() . "+2 days"))]);
        SystemSetup::updateAll(['system_stage' => SystemStage::TI]);

       // Yii::$app->session->setFlash('success', 'EOD completed successfully');


    }

    public function startProcess($process)
    {
        $eod_process = new Eod();
        $eod_process->process_function = $process;
        $eod_process->starttime = SystemDate::getCurrentDate() . ' ' . date('H:i:s');
        $eod_process->save();

        return $eod_process->id;

    }

    public function endProcess($id, $status, $remarks)
    {
        $eod_process = Eod::findOne($id);
        $eod_process->endtime = SystemDate::getCurrentDate() . ' ' . date('H:i:s');
        $eod_process->status = $status;
        $eod_process->process_description = $remarks;
        $eod_process->save();
    }


    public function startEodProcess($process)
    {
        $eod_process = new EodCycle();
        $eod_process->stage = $process;
        $eod_process->start_time = SystemDate::getCurrentDate() . ' ' . date('H:i:s');
        $eod_process->save();

        return $eod_process->id;

    }

    public function endEodProcess($id, $status, $remarks)
    {
        $eod_process = EodCycle::findOne($id);
        $eod_process->end_time = SystemDate::getCurrentDate() . ' ' . date('H:i:s');
        $eod_process->status = $status;
        $eod_process->remarks = $remarks;
        $eod_process->save();
    }

    public function actionRunEoti()
    {
        $processid = $this->startEodProcess('End of Transaction Input');
        for ($i = 0; $i <= 3; $i++) {
            if ($i == 0) {

                $id = $this->startProcess('Check Unauthorised Transactions');
                $result = $this->findUnauthorised();
                if ($result == null) {
                    $this->endProcess($id, $status = 'S', 'Successfully completed');
                    SystemSetup::updateAll(['system_stage' => SystemStage::EOFI]);
                } else {
                    $this->endProcess($id, $status = 'F', $result);
                }

            }

            /*if($i==1){

                $this->startProcess(SystemStage::EOTI);
                $result=$this->findUnauthorised();
                if($result==null){
                    $this->endProcess($status='S','Successfully completed');
                }else{
                    $this->endProcess($status='F',$result);
                }

            }*/

        }
        $this->endEodProcess($processid, 'S', 'Completed');
    }



    public function actionRunEofi()
    {
        $processid = $this->startEodProcess('End of Financial Input');
        for ($i = 0; $i <= 3; $i++) {
            if ($i == 0) {

                $id = $this->startProcess('check Loan with penalty');
                $result = $this->findMatured();
                if ($result == null) {
                    $this->endProcess($id, $status = 'S', 'Successfully completed');

                } else {

                    foreach ($result as $res) {
                        $this->calculateLoanCharges($res->contract_ref_no,$res->amount,$res->maturity_date);
                        //SystemSetup::updateAll(['system_stage' => SystemStage::EOD]);
                    }
                }

            }

            if($i==1){
                $id = $this->startProcess('change Loan statuses');
                $this->startProcess(SystemStage::EOTI);
                $result = $this->findMatured();

                if ($result == null) {
                    $this->endProcess($id, $status = 'S', 'Successfully completed');
                    //SystemSetup::updateAll(['system_stage' => SystemStage::EOD]);
                } else {

                    foreach ($result as $res) {
                       $this->changeLoanStatus($res->contract_ref_no,$res->maturity_date);
                        $this->endProcess($id, $status = 'S', 'Successfully completed');
                       // SystemSetup::updateAll(['system_stage' => SystemStage::EOD]);
                    }
                }

            }
            SystemSetup::updateAll(['system_stage' => SystemStage::EOD]);
        }

        //$this->endEodProcess($processid, 'S', 'Completed');
    }
    public function actionRunEod()
    {
        $processid = $this->startEodProcess('End of Day');
        $this->changeDate();
        $this->endEodProcess($processid, 'S', 'Completed');

    }

    public function findMatured()
    {
        $matured = ContractMaster::getMatured();
        if ($matured != null) {
            return $matured;
        } else {
            return null;
        }
    }

    public function calculateLoanCharges($refno,$amount,$date)
    {
        $charge=$amount*0.03;

        $findLoan=MaturedLoanCharge::find()->where(['contract_ref_number'=>$refno])->one();
        if($findLoan!=null){
            MaturedLoanCharge::updateAll(['charge_amount'=>$findLoan->charge_amount+$charge,'months'=>$findLoan->months+1],['contract_ref_number'=>$refno]);
        }else{
            $maturedCharge=new MaturedLoanCharge();
            $maturedCharge->contract_ref_number=$refno;
            $maturedCharge->matured_date=$date;
            $maturedCharge->months=0;
            $maturedCharge->charge_amount=$charge;
            $maturedCharge->last_update=SystemDate::getCurrentDate(). ' ' . date('H:i:s');
            $maturedCharge->save();
        }

    }


    public function changeLoanStatus($refno,$date)
    {
        $days=$this->calDays(SystemDate::getCurrentDate(),$date);
        if($days>=2){
            $status='PDO';
            ContractMaster::updateAll(['contract_status'=>$status],['contract_ref_no'=>$refno]);
        }




    }

    public  function  calDays($date2,$date1)
    {
        $diff = strtotime($date2) - strtotime($date1);
        $days = $diff / 60 / 60 / 24;
        return $days;

    }



}
