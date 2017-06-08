<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_branch`.
 */
class m170608_143946_create_tbl_branch_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_branch', [
            'id' => $this->primaryKey(),
            'branch_name'=>$this->string(200)->notNull(),
            'location'=>$this->string(200),
            'status'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_branch');
    }
}
