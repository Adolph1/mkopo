<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_system_setup`.
 */
class m171021_145536_create_tbl_system_setup_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_system_setup', [
            'id' => $this->primaryKey(),
            'system_name' => $this->string(200),
            'system_date' => $this->date(),
            'system_rate' => $this->decimal(10,2),
            'system_grace_period' => $this->string(200),
            'system_version' => $this->string(200),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_system_setup');
    }
}
