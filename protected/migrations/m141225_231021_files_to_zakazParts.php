<?php

class m141225_231021_files_to_zakazParts extends CDbMigration
{
	public function safeUp()
	{
            $this->createTable("ZakazPartsFiles", array(
                'id'            => 'int(11) NOT NULL AUTO_INCREMENT',
                'part_id'       => 'int(11)',
                'orig_name'     => 'varchar(100)',
                'file_name'     => 'varchar(100)',
                'comment'       => 'text',
                'PRIMARY KEY (`id`)'
            ));
	}

	public function down()
	{
		echo "m141225_231021_files_to_zakazParts does not support migration down.\n";
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