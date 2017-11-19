<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_saving`.
 */
class m171016_203137_create_tbl_saving_table extends Migration
{

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_saving', [
            'id' => $this->primaryKey(),
            'customer_number'=>$this->string(200),
            'trn_date'=>$this->date(),
            'amount'=>$this->decimal(10,2),
            'fc_period'=>$this->char(3),
            'fc_year'=>$this->char(10),
            'description'=>$this->string(200),
            'payment_method'=>$this->string(200),
            'reference'=>$this->string(200)->unique(),
            'status'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
            'auth_stat'=>$this->char(1),
            'checker_id'=>$this->string(200),
            'checker_time'=>$this->dateTime(),
            'next_pay_date'=>$this->date(),
        ]);


    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        $this->dropTable('tbl_saving');
    }

}
