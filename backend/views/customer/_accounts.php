<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 10/17/17
 * Time: 9:29 AM
 */
?>

<div class="row">
    <div class="col-md-12">

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Branch</th>
                <th>Opened Date</th>
                <th>Account Number</th>
                <th>Customer Number</th>
                <th>Opening Balance</th>
                <th>Current Balance</th>
                <th>Uncleared Balance</th>

            </tr>
            </thead>
            <tbody>

            <?php
            $accounts=\backend\models\Account::getAllAccounts($model->customer_no);
            if($accounts!=null) {
                foreach ($accounts as $account) {
                    echo '<tr>
                    <td>'.$account->branch_code.'</td>
                    <td>'.$account->acc_open_date.'</td>
                    <td>'.$account->cust_ac_no.'</td>
                    <td>'.$account->cust_no.'</td>
                    <td>'.$account->ac_opening_bal.'</td>
               
                    </tr>';
                }
            }
            ?>


            </tbody>
        </table>
    </div>


</div>
