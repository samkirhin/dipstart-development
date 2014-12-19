<?php

class m141212_144500_add_chat_author_cost extends CDbMigration
{
	public function up()
	{
		$this->addColumn('ProjectMessages', 'cost', 'int');
	}

	public function down()
	{
		$this->dropColumn('ProjectMessages', 'cost');
		echo "m141212_144500_add_chat_author_cost does not support migration down.\n";
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