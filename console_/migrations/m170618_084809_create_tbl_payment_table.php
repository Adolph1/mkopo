<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_payment`.
 */
class m170618_084809_create_tbl_payment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_payment', [
            'id' => $this->primaryKey(),
            'trn_dt'=>$this->date(),
            'contract_ref_number'=>$this->string(200),
            'component'=>$this->string(200),
            'due_date'=>$this->date(),
            'amount_paid'=>$this->decimal(),
            'related_customer'=>$this->string(200),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_payment');
    }
}
