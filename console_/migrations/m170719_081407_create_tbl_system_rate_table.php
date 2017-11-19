<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_system_rate`.
 */
class m170719_081407_create_tbl_system_rate_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_system_rate', [
            'id' => $this->primaryKey(),
            'user_rate'=>$this->decimal(),
            'system_rate'=>$this->decimal(),
            'last_updated'=>$this->dateTime(),
            'last_maker'=>$this->string(200),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_system_rate');
    }
}
