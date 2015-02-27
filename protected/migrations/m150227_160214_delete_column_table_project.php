<?php

class m150227_160214_delete_column_table_project extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('Projects', 'term_for_author');
        $this->dropColumn('ZakazModeration', 'term_for_author');
	}

	public function down()
	{
		
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