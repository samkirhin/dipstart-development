<?php

class m141219_101325_add_changes extends CDbMigration {
    public function up() {

        $this->createTable('ProjectChanges', array(
            'id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'project_id' => 'int(11) NOT NULL',
            'file' => 'varchar(350) DEFAULT NULL',
            'comment' => 'varchar(450) DEFAULT NULL',
            'date_create' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'date_update' => 'timestamp NULL DEFAULT NULL',
            'date_moderate' => 'timestamp NULL DEFAULT NULL',
            'moderate' => 'varchar(45) NOT NULL DEFAULT "0"',
        ), 'ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;');
    }


    public function down() {

        $this->dropTable('ProjectChanges');
        echo "m141219_101325_add_changes does not support migration down.\n";

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