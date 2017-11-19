<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_eod_cycle`.
 */
class m171021_153628_create_tbl_eod_cycle_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_eod_cycle', [
            'id' => $this->primaryKey(),
            'stage'=>$this->string(200),
            'start_time'=>$this->dateTime(),
            'end_time'=>$this->dateTime(),
            'error_code'=>$this->string(200),
            'status'=>$this->char(1),
            'remarks'=>$this->string(200),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_eod_cycle');
    }
}
