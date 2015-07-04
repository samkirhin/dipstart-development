<?php

class m150228_223553_projects_parts_change extends CDbMigration
{
    public function up()
    {
        ALTER TABLE `ProjectsParts` CHANGE `show` `show` TINYINT(1) NULL DEFAULT '0';
	}

    public function down()
    {
        echo "m150228_223553_projects_parts_change does not support migration down.\n";
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