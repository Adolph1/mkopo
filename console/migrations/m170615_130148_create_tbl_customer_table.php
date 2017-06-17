<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_customer`.
 */
class m170615_130148_create_tbl_customer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_customer', [
            'id' => $this->primaryKey(),
            'customer_no'=>$this->string(10)->unique()->notNull(),
            'first_name'=>$this->string(200)->notNull(),
            'middle_name'=>$this->string(200),
            'last_name'=>$this->string(200)->notNull(),
            'identification_id'=>$this->integer()->notNull(),
            'identification_number'=>$this->string(200)->notNull(),
            'expire_date'=>$this->date()->notNull(),
            'address'=>$this->string(200),
            'mobile_no1'=>$this->char(13)->notNull(),
            'mobile_no2'=>$this->char(13),
            'email'=>$this->string(200),
            'customer_type_id'=>$this->integer()->notNull(),
            'customer_category_id'=>$this->integer(),
            'branch_id'=>$this->integer(),
            'photo'=>$this->string(200),
            'mod_no'=>$this->integer(),
            'record_stat'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);
        // creates index for column `identification_id`
        $this->createIndex(
            'idx-tbl_customer-identification_id',
            'tbl_customer',
            'identification_id'
        );


        // add foreign key for table `tbl_customer_identification`
        $this->addForeignKey(
            'fk-tbl_customer-identification_id',
            'tbl_customer',
            'identification_id',
            'tbl_customer_identification',
            'id',
            'RESTRICT'
        );


        //////////////////////////////////////////////////////////////

        // creates index for column `customer_type_id`
        $this->createIndex(
            'idx-tbl_customer-customer_type_id',
            'tbl_customer',
            'customer_type_id'
        );


        // add foreign key for table `tbl_customer_type`
        $this->addForeignKey(
            'fk-tbl_customer-customer_type_id',
            'tbl_customer',
            'customer_type_id',
            'tbl_customer_type',
            'id',
            'RESTRICT'
        );

        //////////////////////////////////////////////////////////////




        //////////////////////////////////////////////////////////////

        // creates index for column `customer_category_id`
        $this->createIndex(
            'idx-tbl_customer-customer_category_id',
            'tbl_customer',
            'customer_category_id'
        );


        // add foreign key for table `tbl_customer_category`
        $this->addForeignKey(
            'fk-tbl_customer-customer_category_id',
            'tbl_customer',
            'customer_category_id',
            'tbl_customer_category',
            'id',
            'RESTRICT'
        );

        //////////////////////////////////////////////////////////////


        //////////////////////////////////////////////////////////////

        // creates index for column `branch_id`
        $this->createIndex(
            'idx-tbl_customer-branch_id',
            'tbl_customer',
            'branch_id'
        );


        // add foreign key for table `tbl_branch`
        $this->addForeignKey(
            'fk-tbl_customer-branch_id',
            'tbl_customer',
            'branch_id',
            'tbl_branch',
            'id',
            'RESTRICT'
        );

        //////////////////////////////////////////////////////////////
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-tbl_customer-branch_id',
            'tbl_customer'
        );

        // drops index for column `branch_id`
        $this->dropIndex(
            'idx-tbl_customer-branch_id',
            'tbl_customer'
        );


//////////////////////////////////////////////////////////////

        $this->dropForeignKey(
            'fk-tbl_customer-customer_category_id',
            'tbl_customer'
        );

        // drops index for column `customer_category_id`
        $this->dropIndex(
            'idx-tbl_customer-customer_category_id',
            'tbl_customer'
        );


//////////////////////////////////////////////////////////////

        $this->dropForeignKey(
            'fk-tbl_customer-customer_type_id',
            'tbl_customer'
        );

        // drops index for column `customer_category_id`
        $this->dropIndex(
            'idx-tbl_customer-customer_type_id',
            'tbl_customer'
        );


//////////////////////////////////////////////////////////////

        $this->dropForeignKey(
            'fk-tbl_customer-identification_id',
            'tbl_customer'
        );

        // drops index for column `customer_category_id`
        $this->dropIndex(
            'idx-tbl_customer-identification_id',
            'tbl_customer'
        );
        $this->dropTable('tbl_customer');
    }
}
