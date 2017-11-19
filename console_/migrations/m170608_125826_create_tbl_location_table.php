<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_location`.
 */
class m170608_125826_create_tbl_location_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_location', [
            'id' => $this->primaryKey(),
            'location_name'=>$this->string(200)->notNull(),
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
        $this->dropTable('tbl_location');
    }
}
