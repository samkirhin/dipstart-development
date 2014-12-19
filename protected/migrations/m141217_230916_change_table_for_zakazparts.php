<?php

class m141217_230916_change_table_for_zakazparts extends CDbMigration
{
	public function up()
	{
            $this->dropColumn('ProjectsParts', 'add_demands');
            $this->dropColumn('ProjectsParts', 'text');
            $this->dropColumn('ProjectsParts', 'max_exec_date');
            $this->dropColumn('ProjectsParts', 'pages');
            $this->dropColumn('ProjectsParts', 'budget');
            $this->dropColumn('ProjectsParts', 'date_finish');
            $this->addColumn('ProjectsParts', 'payment', 'varchar(255)');
            $this->addColumn('ProjectsParts', 'comment', 'varchar(255)');
            $this->addColumn('ProjectsParts', 'show', 'tinyint(1)');
            $this->addColumn('ProjectsParts', 'author_id', 'varchar(100)');
	}

	public function down()
	{
		$this->addColumn('ProjectsParts', 'add_demands');
                $this->addColumn('ProjectsParts', 'text');
                $this->addColumn('ProjectsParts', 'max_exec_date');
                $this->addColumn('ProjectsParts', 'pages');
                $this->addColumn('ProjectsParts', 'budget');
                $this->addColumn('ProjectsParts', 'date_finish');
                $this->dropColumn('ProjectsParts', 'payment');
                $this->dropColumn('ProjectsParts', 'comment');
                $this->dropColumn('ProjectsParts', 'show');
                $this->dropColumn('ProjectsParts', 'author_id');
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