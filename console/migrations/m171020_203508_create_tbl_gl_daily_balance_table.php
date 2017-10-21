<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_gl_daily_balance`.
 */
class m171020_203508_create_tbl_gl_daily_balance_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_gl_daily_balance', [
            'id' => $this->primaryKey(),
            'trn_date'=>$this->date(),
            'gl_code'=>$this->string(20),
            'opening_balance'=>$this->decimal(10,2),
            'dr_turn'=>$this->decimal(10,2),
            'cr_turn'=>$this->decimal(10,2),
            'closing_balance'=>$this->decimal(10,2)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_gl_daily_balance');
    }
}
