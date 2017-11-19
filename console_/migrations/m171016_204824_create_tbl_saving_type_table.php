<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_saving_type`.
 */
class m171016_204824_create_tbl_saving_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_saving_type', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(200),
            'status'=>$this->char(1),
            'last_update'=>$this->dateTime(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_saving_type');
    }
}
