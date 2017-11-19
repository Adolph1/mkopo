<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_teller`.
 */
class m170618_095418_create_tbl_teller_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_teller', [
            'id' => $this->primaryKey(),
            'reference'=>$this->string(200)->notNull()->unique(),
            'product'=>$this->string(200),
            'trn_dt'=>$this->date(),
            'amount'=>$this->decimal(10,2),
            'related_customer'=>$this->string(200),
            'offset_account'=>$this->string(200),
            'offset_amount'=>$this->decimal(10,2),
            'status'=>$this->char(1),
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
        $this->dropTable('tbl_teller');
    }
}
