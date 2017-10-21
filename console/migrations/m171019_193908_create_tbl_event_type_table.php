<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_event_type`.
 */
class m171019_193908_create_tbl_event_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_event_type', [
            'id' => $this->primaryKey(),
            'event_title'=>$this->string(200),
            'description'=>$this->string(200),
            'status'=>$this->char(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_event_type');
    }
}
