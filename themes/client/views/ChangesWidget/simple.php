<h5 class="title"><?=ProjectModule::t('Needs rework');?>:</h5>
<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $changes,
	'itemView' => '_list',
	'summaryCssClass' => 'hidden',
	'emptyText' => '',
	'enablePagination' => false,
));?>