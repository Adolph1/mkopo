<?php

namespace console\controllers;

use backend\models\ContractAmountDue;
use backend\models\ContractBalance;
use backend\models\ReferenceIndex;
use backend\models\SystemDate;
use backend\models\TodayEntry;
use Yii;
use yii\console\Controller;
use backend\models\ContractMaster;


/**
 * BGEmailController implements the CRUD actions for BGEmail model.
 */
class EodController extends Controller
{

    public function actionCheckMaturity()
    {
        $unauthorised = TodayEntry::getUnauthorised();
        //print_r($unauthorised);
        if ($unauthorised > 0) {
            Yii::$app->session->setFlash('danger', 'You have unauthorized transactions,kindly check your cycle');
        } elseif($unauthorised==0) {
            $matures = ContractMaster::getMatured();
            if ($matures != null) {
                foreach ($matures as $mature) {
                    $outstanding = ContractBalance::getOutstanding($mature->contract_ref_no);
                    if ($outstanding != 0.00) {
                        $activeDues = ContractAmountDue::getIDByReference($mature->contract_ref_no);
                        foreach ($activeDues as $activeDue) {
                            ContractAmountDue::updateAll(['status' => 'S'], ['id' => $activeDue]);
                        }
                        //re-books loan
                        ContractMaster::reBook($mature->contract_ref_no, $outstanding, $mature->customer_number);

                    } else {
                        ContractMaster::updateAll(['contract_status' => 'L'], ['contract_ref_no' => $mature->contract_ref_no]);
                    }
                }
            }
            ReferenceIndex::deleteAll();
            SystemDate::updateAll(['previous_working_day' => SystemDate::getCurrentDate(), 'current_working_day' => date('Y-m-d', strtotime(SystemDate::getCurrentDate() . "+1 days")), 'next_working_day' => date('Y-m-d', strtotime(SystemDate::getCurrentDate() . "+2 days"))]);
            Yii::$app->session->setFlash('success', 'Eod run successfully');

        }
    }


}
