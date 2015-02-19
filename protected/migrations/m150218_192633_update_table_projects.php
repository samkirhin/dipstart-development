<?php

class m150218_192633_update_table_projects extends CDbMigration
{
	public function up()
	{
        $this->addColumn('Projects', 'payment_image', 'string');
        $this->addColumn('ZakazModeration', 'payment_image', 'string');
	}

	public function down()
	{
		$this->dropColumn('Projects', 'payment_image');
        $this->dropColumn('ZakazModeration', 'payment_image');
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