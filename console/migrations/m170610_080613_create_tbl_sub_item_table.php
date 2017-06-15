<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_sub_item`.
 */
class m170610_080613_create_tbl_sub_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_sub_item', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(200)->notNull(),
            'description'=>$this->string(200),
            'item_id'=>$this->integer(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),

        ]);
        // creates index for column `item_id`
        $this->createIndex(
            'idx-tbl_sub_item-item_id',
            'tbl_sub_item',
            'item_id'
        );


        // add foreign key for table `tbl_item`
        $this->addForeignKey(
            'fk-tbl_sub_item-item_id',
            'tbl_sub_item',
            'item_id',
            'tbl_item',
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
            'fk-tbl_sub_item-item_id',
            'tbl_sub_item'
        );

        // drops index for column `item_id`
        $this->dropIndex(
            'idx-tbl_sub_item-item_id',
            'tbl_sub_item'
        );
        $this->dropTable('tbl_sub_item');
    }
}
