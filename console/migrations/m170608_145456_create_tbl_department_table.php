<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_department`.
 */
class m170608_145456_create_tbl_department_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_department', [
            'id' => $this->primaryKey(),
            'dept_name'=>$this->string(200)->notNull(),
            'branch_id'=>$this->integer(),
            'status'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);

        // creates index for column `branch_id`
        $this->createIndex(
            'idx-tbl_department-branch_id',
            'tbl_department',
            'branch_id'
        );


        // add foreign key for table `tbl_branch`
        $this->addForeignKey(
            'fk-tbl_department-branch_id',
            'tbl_department',
            'branch_id',
            'tbl_branch',
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
            'fk-tbl_department-branch_id',
            'tbl_department'
        );

        // drops index for column `branch_id`
        $this->dropIndex(
            'idx-tbl_department-branch_id',
            'tbl_department'
        );
        $this->dropTable('tbl_department');
    }
}
