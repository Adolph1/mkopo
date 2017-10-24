<?php

namespace console\controllers;

use backend\models\ContractAmountDue;
use backend\models\ContractBalance;
use backend\models\EodCycle;
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


    public function actionCheckUnauthorised()
    {
        $eod_cycle=new EodCycle();
        $eod_cycle->stage='End of Transaction Input';
        $eod_cycle->start_time=SystemDate::getCurrentDate().' '.date('H:i:s');
        $eod_cycle->save();

        $unauthorised = TodayEntry::getUnauthorised();

        if ($unauthorised > 0) {

            $eod_cycle=EodCycle::findOne($eod_cycle->id);
            $eod_cycle->end_time=SystemDate::getCurrentDate().' '.date('H:i:s');
            $eod_cycle->status='E';
            $eod_cycle->remarks='There are unauthorised transactions,kindly check EOD cycle';
            $eod_cycle->save();



        } elseif($unauthorised==0) {
            /*$matures = ContractMaster::getMatured();
            if ($matures != null) {
                foreach ($matures as $mature) {
                    $outstanding = ContractBalance::getOutstanding($mature->contract_ref_no);
                    if ($outstanding != 0.00) {
                        $activeDues = ContractAmountDue::getIDByReference($mature->contract_ref_no);
                        foreach ($activeDues as $activeDue) {
                            ContractAmountDue::updateAll(['status' => 'S'], ['id' => $activeDue]);
                        }
                        ContractMaster::reBook($mature->contract_ref_no, $outstanding, $mature->customer_number);

                    } else {
                        ContractMaster::updateAll(['contract_status' => 'L'], ['contract_ref_no' => $mature->contract_ref_no]);
                    }
                }
            }
            ReferenceIndex::deleteAll();
            SystemDate::updateAll(['previous_working_day' => SystemDate::getCurrentDate(), 'current_working_day' => date('Y-m-d', strtotime(SystemDate::getCurrentDate() . "+1 days")), 'next_working_day' => date('Y-m-d', strtotime(SystemDate::getCurrentDate() . "+2 days"))]);
            Yii::$app->session->setFlash('success', 'EOD completed successfully');

            */

            $eod_cycle=EodCycle::findOne($eod_cycle->id);
            $eod_cycle->end_time=SystemDate::getCurrentDate().' '.date('H:i:s');
            $eod_cycle->status='S';
            $eod_cycle->remarks='Successfully executed';
            $eod_cycle->save();



            ReferenceIndex::deleteAll();
            SystemSetup::updateAll(['system_stage'=>SystemStage::EOTI]);
            //SystemDate::updateAll(['previous_working_day' => SystemDate::getCurrentDate(), 'current_working_day' => date('Y-m-d', strtotime(SystemDate::getCurrentDate() . "+1 days")), 'next_working_day' => date('Y-m-d', strtotime(SystemDate::getCurrentDate() . "+2 days"))]);
            Yii::$app->session->setFlash('success', 'EOD completed successfully');
        }



    }



}
