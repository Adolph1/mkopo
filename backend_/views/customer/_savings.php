<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 10/17/17
 * Time: 8:14 AM
 */
?>
<div class="row">
    <div class="col-md-12">

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Transaction Date</th>
                <th>Account</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>

        <?php
        $transactions=\backend\models\Teller::getAllTransactions($model->customer_no);
        if($transactions!=null) {
            foreach ($transactions as $transaction) {
                echo '<tr>
                    <td>'.$transaction->trn_dt.'</td>
                    <td>'.$transaction->txn_account.'</td>
                    <td>'.$transaction->amount.'</td>
                    <td>'.$transaction->status.'</td>
               
                    </tr>';
            }
        }
        ?>


                </tbody>
            </table>
        </div>


</div>