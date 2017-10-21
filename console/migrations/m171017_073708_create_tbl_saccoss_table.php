<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_saccoss`.
 */
class m171017_073708_create_tbl_saccoss_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_saccoss', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(200)->notNull(),
            'background'=>$this->text(),
            'address'=>$this->string(200),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_saccoss');
    }
}
