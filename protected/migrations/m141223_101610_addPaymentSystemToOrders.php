<?php

class m141223_101610_addPaymentSystemToOrders extends CDbMigration
{
	public function safeUp()
	{
            $this->createTable("ProjectPayments", array(
                'id'            => 'int(11) NOT NULL AUTO_INCREMENT',
                'order_id'      => 'int(11)',
                'project_price' => 'float(10,2)',
                'work_price'    => 'float(10,2)',
                'received'      => 'float(10,2)',
                'approved_in'   => 'float(10,2)',
                'approved_out'  => 'float(10,2)',
                'to_receive'    => 'float(10,2)',
                'to_pay'        => 'float(10,2)',
                'payed'         => 'float(10,2)',
                'PRIMARY KEY (`id`)'
            ));
	}

	public function down()
	{
		echo "m141223_101610_addPaymentSystemToOrders does not support migration down.\n";
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