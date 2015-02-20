<?php

class m150220_173850_update_profile extends CDbMigration
{
	public function up()
	{

		$this->createTable('UpdateProfile', array(
			'id'				=> 'pk',
			'user'				=> "int(11)			NOT NULL	COMMENT 'Пользователь'",
			'attribute'			=> "VARCHAR(255)	NOT NULL	COMMENT 'Атрибут'",
			'from_data'			=> "TEXT			NULL		COMMENT 'Старое значение'",
			'to_data'			=> "TEXT			NULL		COMMENT 'Новое значение'",
			'status'			=> "TINYINT(1)		NULL		COMMENT 'Статус'",
			'date_update'		=> "INT(11)			NOT NULL	COMMENT 'Дата изменения'",
		), 'ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci');
	}

	public function down()
	{
		// очистка
		$this->dropTable('UpdateProfile');
	}
}