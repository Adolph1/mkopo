<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_customer_type`.
 */
class m170615_125018_create_tbl_customer_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_customer_type', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(200)->notNull(),
            'indicator'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_customer_type');
    }
}
