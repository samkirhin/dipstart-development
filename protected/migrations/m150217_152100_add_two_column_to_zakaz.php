<?php

class m150217_152100_add_two_column_to_zakaz extends CDbMigration
{
	public function up()
	{
        $this->addColumn('Projects', 'term_for_author', 'string');
        $this->addColumn('ZakazModeration', 'term_for_author', 'string');
	}

	public function down()
	{
		$this->dropColumn('Projects', 'term_for_author');
        $this->dropColumn('ZakazModeration', 'term_for_author');
	}
}