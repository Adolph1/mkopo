<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_customer_identification`.
 */
class m170615_125746_create_tbl_customer_identification_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_customer_identification', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(200)->notNull(),
            'indicator'=>$this->char(10),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_customer_identification');
    }
}
