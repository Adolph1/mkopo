<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_group_member`.
 */
class m171112_082212_create_tbl_group_member_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_group_member', [
            'id' => $this->primaryKey(),
            'member_number'=>$this->string(200)->notNull(),
            'group_id'=>$this->integer()->notNull(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_group_member');
    }
}
