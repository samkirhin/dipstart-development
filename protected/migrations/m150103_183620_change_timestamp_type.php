<?php

class m150103_183620_change_timestamp_type extends CDbMigration
{
	public function safeUp()
	{
            $this->dropColumn('Projects', 'date');
            $this->dropColumn('Projects', 'date_finish');
            $this->dropColumn('Projects', 'max_exec_date');
            $this->dropColumn('Projects', 'informed');
            $this->addColumn('Projects', 'date', 'int(11)');
            $this->addColumn('Projects', 'date_finish', 'int(11)');
            $this->addColumn('Projects', 'max_exec_date', 'int(11)');
            $this->addColumn('Projects', 'manager_informed', 'int(11)');
            $this->addColumn('Projects', 'author_informed', 'int(11)');
            $this->addColumn('Projects', 'author_notes', 'text');
            $this->addColumn('Projects', 'user_notes', 'text');
            $this->addColumn('Projects', 'user_notes_show', 'text');
	}

	public function down()
	{
            echo "m150103_183620_change_timestamp_type does not support migration down.\n";
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