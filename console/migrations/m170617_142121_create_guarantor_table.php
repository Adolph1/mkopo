<?php

use yii\db\Migration;

/**
 * Handles the creation of table `guarantor`.
 */
class m170617_142121_create_guarantor_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_guarantor', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(200)->notNull(),
            'phone_number'=>$this->char(13)->notNull(),
            'contract_ref_number'=>$this->string(200),
            'identification'=>$this->integer(),
            'identification_number'=>$this->string(200),
            'related_customer'=>$this->string(200),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),


        ]);


    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        $this->dropTable('tbl_guarantor');
    }
}
