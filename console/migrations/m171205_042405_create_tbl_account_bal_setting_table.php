<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_account_bal_setting`.
 */
class m171205_042405_create_tbl_account_bal_setting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_account_bal_setting', [
            'id' => $this->primaryKey(),
            'account_class'=>$this->string(200)->notNull()->unique(),
            'minimum_balance'=>$this->decimal(10,2)->notNull(),
            'maker_id'=>$this->string(200),
            'last_update'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_account_bal_setting');
    }
}
