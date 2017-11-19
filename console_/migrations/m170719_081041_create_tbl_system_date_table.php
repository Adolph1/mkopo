<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_system_date`.
 */
class m170719_081041_create_tbl_system_date_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_system_date', [
            'id' => $this->primaryKey(),
            'previous_working_day'=>$this->date(),
            'current_working_day'=>$this->date(),
            'next_working_day'=>$this->date(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_system_date');
    }
}
