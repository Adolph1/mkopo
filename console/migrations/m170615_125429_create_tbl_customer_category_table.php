<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_customer_category`.
 */
class m170615_125429_create_tbl_customer_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_customer_category', [
            'id' => $this->primaryKey(),
            'category'=>$this->string(200)->notNull(),
            'code'=>$this->char(10),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_customer_category');
    }
}
