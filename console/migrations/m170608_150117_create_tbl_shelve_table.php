<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_shelve`.
 */
class m170608_150117_create_tbl_shelve_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_shelve', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(200)->notNull(),
            'loc_id'=>$this->integer(),
            'max_box_no'=>$this->integer(),
            'balance'=>$this->integer(),
            'status'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);

        // creates index for column `loc_id`
        $this->createIndex(
            'idx-tbl_shelve-loc_id',
            'tbl_shelve',
            'loc_id'
        );


        // add foreign key for table `tbl_location`
        $this->addForeignKey(
            'fk-tbl_shelve-loc_id',
            'tbl_shelve',
            'loc_id',
            'tbl_location',
            'id',
            'RESTRICT'
        );


    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-tbl_shelve-loc_id',
            'tbl_shelve'
        );

        // drops index for column `branch_id`
        $this->dropIndex(
            'idx-tbl_shelve-loc_id',
            'tbl_shelve'
        );
        $this->dropTable('tbl_shelve');
    }
}
