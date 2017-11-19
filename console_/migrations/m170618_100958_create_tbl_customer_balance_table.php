<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_customer_balance`.
 */
class m170618_100958_create_tbl_customer_balance_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_customer_balance', [
            'id' => $this->primaryKey(),
            'customer_number'=>$this->string(200)->unique()->notNull(),
            'opening_balance'=>$this->decimal(10,2),
            'current_balance'=>$this->decimal(10,2),
            'last_updated'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_customer_balance');
    }
}
