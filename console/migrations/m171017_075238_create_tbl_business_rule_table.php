<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_business_rule`.
 */
class m171017_075238_create_tbl_business_rule_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_business_rule', [
            'id' => $this->primaryKey(),
            'rule_code'=>$this->string(4)->unique(),
            'rule_title'=>$this->string(200),
            'number'=>$this->integer(),
            'description'=>$this->string(200),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_business_rule');
    }
}
