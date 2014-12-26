<?php

class m141219_203355_create_payment_system extends CDbMigration
{
	public function safeUp()
	{
            $this->createTable("Payment", array(
                'id' => 'int NOT NULL AUTO_INCREMENT',
                'order_id' => 'int',
                'receive_date' => 'date',
                'pay_date' => 'date',
                'theme' => 'varchar(255)',
                'manager' => 'varchar(100)',
                'user' => 'varchar(100)',
                'summ' => 'float(10,2)',
                'details_ya' => 'varchar(255)',
                'details_wm' => 'varchar(255)',
                'details_bank' => 'text',
                'payment_type' => 'tinyint(1)',
                'approve' => 'tinyint(1)',
                'method' => 'varchar(100)',
                'PRIMARY KEY (`id`)'
            ));
	}

	public function down()
	{
		echo "m141219_203355_create_payment_system does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}