<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_group`.
 */
class m171112_081218_create_tbl_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_group', [
            'id' => $this->primaryKey(),
            'group_name'=>$this->string(200)->notNull(),
            'group_number'=>$this->string(10),
            'branch_code'=>$this->string(10)->notNull(),
            'location'=>$this->string(200)->notNull(),
            'loan_officer'=>$this->integer()->notNull(),
            'registration_date'=>$this->date()->notNull(),
            'auth_status'=>$this->char(1),
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
        $this->dropTable('tbl_group');
    }
}
