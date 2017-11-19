<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_contract_balance`.
 */
class m170717_092540_create_tbl_contract_balance_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_contract_balance', [
            'id' => $this->primaryKey(),
            'contract_ref_number'=>$this->string(200)->unique(),
            'contract_amount'=>$this->decimal(),
            'contract_outstanding'=>$this->decimal(),
            'last_updated'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_contract_balance');
    }
}
