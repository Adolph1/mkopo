<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_system_stage`.
 */
class m171021_201624_create_tbl_system_stage_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_system_stage', [
            'id' => $this->primaryKey(),
            'stage'=>$this->string(200),
            'status'=>$this->char(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_system_stage');
    }
}
