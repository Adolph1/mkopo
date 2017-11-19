<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_contract_payment`.
 */
class m171029_151127_create_tbl_contract_payment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_contract_payment', [
            'id' => $this->primaryKey(),
            'trn_dt'=>$this->date(),
            'transaction_type'=>$this->integer(),
            'contract_ref_number'=>$this->string(200),
            'debit'=>$this->decimal(10,2),
            'credit'=>$this->decimal(10,2),
            'balance'=>$this->decimal(10,2),
            'description'=>$this->string(200),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
            'auth_stat'=>$this->char(1),
            'checker_id'=>$this->decimal(10,2),
            'checker_time'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_contract_payment');
    }
}
