<?php

class m150211_121753_update_profile extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('Profiles', 'city', 'VARCHAR(100) DEFAULT ""');
	}

	public function down()
	{
		$this->alterColumn('Profiles', 'city', 'int');
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