<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_contribution_type`.
 */
class m171117_135814_create_tbl_contribution_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_contribution_type', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(200)->notNull(),
            'description'=>$this->string(200),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_contribution_type');
    }
}
