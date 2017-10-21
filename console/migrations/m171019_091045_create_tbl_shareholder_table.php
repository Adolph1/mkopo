<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_shareholder`.
 */
class m171019_091045_create_tbl_shareholder_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_shareholder', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(200)->notNull(),
            'description'=>$this->text(),
            'address'=>$this->string(200),
            'joining_date'=>$this->date(),
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
        $this->dropTable('tbl_shareholder');
    }
}
