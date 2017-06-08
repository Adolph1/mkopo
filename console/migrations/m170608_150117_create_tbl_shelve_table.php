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
            'branch_id'=>$this->integer(),
            'dept_id'=>$this->integer(),
            'max_box_no'=>$this->integer(),
            'status'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);

        // creates index for column `branch_id`
        $this->createIndex(
            'idx-tbl_shelve-branch_id',
            'tbl_shelve',
            'branch_id'
        );


        // add foreign key for table `tbl_branch`
        $this->addForeignKey(
            'fk-tbl_shelve-branch_id',
            'tbl_shelve',
            'branch_id',
            'tbl_branch',
            'id',
            'RESTRICT'
        );

        // creates index for column `branch_id`
        $this->createIndex(
            'idx-tbl_shelve-dept_id',
            'tbl_shelve',
            'dept_id'
        );


        // add foreign key for table `tbl_branch`
        $this->addForeignKey(
            'fk-tbl_shelve-dept_id',
            'tbl_shelve',
            'dept_id',
            'tbl_department',
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
            'fk-tbl_shelve-dept_id',
            'tbl_shelve'
        );

        // drops index for column `branch_id`
        $this->dropIndex(
            'idx-tbl_shelve-dept_id',
            'tbl_shelve'
        );
        $this->dropForeignKey(
            'fk-tbl_shelve-branch_id',
            'tbl_shelve'
        );

        // drops index for column `branch_id`
        $this->dropIndex(
            'idx-tbl_shelve-branch_id',
            'tbl_shelve'
        );
        $this->dropTable('tbl_shelve');
    }
}
