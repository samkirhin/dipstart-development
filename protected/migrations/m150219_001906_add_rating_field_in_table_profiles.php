<?php

class m150219_001906_add_rating_field_in_table_profiles extends CDbMigration
{
	public function up()
	{
		$this->addColumn('Profiles', 'rating', 'int(3)');
	}

	public function down()
	{
		$this->dropColumn('Profiles', 'rating');
	}
}