<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_matured_loan_charge`.
 */
class m171031_192636_create_tbl_matured_loan_charge_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_matured_loan_charge', [
            'id' => $this->primaryKey(),
            'contract_ref_number'=>$this->string(200)->unique(),
            'matured_date'=>$this->date(),
            'charge_amount'=>$this->decimal(10,2),
            'months'=>$this->integer(),
            'last_update'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_matured_loan_charge');
    }
}
