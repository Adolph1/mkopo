<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_journal_entry`.
 */
class m171104_061411_create_tbl_journal_entry_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_journal_entry', [
            'id' => $this->primaryKey(),
            'trn_ref_no'=>$this->string(200)->unique(),
            'trn_dt'=>$this->date()->notNull(),
            'cr_ind'=>$this->char(1)->notNull(),
            'txn_account'=>$this->string(200)->notNull(),
            'amount'=>$this->decimal(10,2)->notNull(),
            'offset_account'=>$this->string(200)->notNull(),
            'offset_amount'=>$this->decimal(10,2)->notNull(),
            'dr_ind'=>$this->char(1)->notNull(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
            'auth_stat'=>$this->char(1),
            'trn_status'=>$this->char(1),
            'checker_id'=>$this->string(200),
            'checker_time'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_journal_entry');
    }
}
