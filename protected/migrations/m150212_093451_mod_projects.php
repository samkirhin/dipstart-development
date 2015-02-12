<?php

class m150212_093451_mod_projects extends CDbMigration
{
	public function up()
	{
		$this->addColumn('Projects', 'time_for_call', 'string'); //Удобное время для связи
		$this->addColumn('Projects', 'edu_dep', 'string'); // Учебное заведение
		$this->addColumn('ZakazModeration', 'time_for_call', 'string');
		$this->addColumn('ZakazModeration', 'edu_dep', 'string');
	}

	public function down()
	{
		$this->dropColumn('Projects', 'time_for_call');
		$this->dropColumn('Projects', 'edu_dep');
		$this->dropColumn('ZakazModeration', 'time_for_call');
		$this->dropColumn('ZakazModeration', 'edu_dep');
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