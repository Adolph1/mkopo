<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_contribution`.
 */
class m171117_101312_create_tbl_contribution_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_contribution', [
            'id' => $this->primaryKey(),
            'trn_ref_no'=>$this->string(200),
            'trn_dt'=>$this->date(),
            'payment_date'=>$this->date(),
            'payment_type'=>$this->integer(),
            'customer_number'=>$this->string(20),
            'product'=>$this->string(200),
            'amount'=>$this->decimal(10,2),
            'contribution_type'=>$this->integer(),
            'period'=>$this->char(3),
            'financial_year'=>$this->char(6),
            'reference'=>$this->string(200),
            'description'=>$this->string(200),
            'auth_stat'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
            'checker_id'=>$this->string(200),
            'checker_time'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_contribution');
    }
}
