<?php

class m150108_091546_create_orders_moderation_table extends CDbMigration
{
	public function safeUp()
	{
            
            $this->createTable("ProjectsEvents", array(
                'id'            => 'int(11) NOT NULL AUTO_INCREMENT',
                'type'          => 'varchar(100)',
                'event_id'      => 'int(11)',
                'description'   => 'text',
                'timestamp'     => 'int(11)',
                'status'        => 'tinyint(2)',
                'PRIMARY KEY (`id`)'
            ));
            
            $this->dropColumn("Projects", 'with_prepayment');
            $this->dropColumn("Projects", 'author_payed');
            $this->dropColumn("Projects", 'author_price');
            $this->dropColumn("Projects", 'budget');
            $this->dropColumn("Projects", 'customer_price');
            $this->dropColumn("Projects", 'file');
            $this->dropColumn("Projects", 'is_payed');
            
            $this->createTable("ZakazModeration", array(
                'id'                => 'int(11) NOT NULL AUTO_INCREMENT',
                'order_id'          => 'int(11)',
                'add_demands'       => 'text',
                'author_informed'   => 'int(11)',
                'author_notes'      => 'text',
                'user_id'           => 'int(11)',
                'executor'          => 'int(11)',
                'category_id'       => 'smallint(6)',
                'job_id'            => 'tinyint(3)',
                'title'             => 'varchar(255)',
                'text'              => 'text',
                'date'              => 'int(11)',
                'max_exec_date'     => 'int(11)',
                'date_finish'       => 'int(11)',
                'manager_informed'  => 'int(11)',
                'author_informed'   => 'int(11)',
                'pages'             => 'int(5)',
                'status'            => 'tinyint(4)',
                'notes'             => 'text',
                'user_notes'        => 'text',
                'user_notes_show'   => 'text',
                'event_creator_id'  => 'int(11)',
                'timestamp'         => 'int(11)',
                'PRIMARY KEY (`id`)'
            ));
	}

	public function down()
	{
		echo "m150108_091546_create_orders_moderation_table does not support migration down.\n";
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