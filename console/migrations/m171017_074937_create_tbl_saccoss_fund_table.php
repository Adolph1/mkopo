<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_saccoss_fund`.
 */
class m171017_074937_create_tbl_saccoss_fund_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_saccoss_fund', [
            'id' => $this->primaryKey(),
            'organisation'=>$this->string(200),
            'description'=>$this->string(200)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_saccoss_fund');
    }
}
