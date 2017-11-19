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
            'credit_account'=>$this->string(200)->notNull(),
            'amount'=>$this->decimal(10,2)->notNull(),
            'debit_account'=>$this->string(200)->notNull(),
            'description'=>$this->string(200),
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
