<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
<?= YII::t( 'project', 'This is the view content for action').' "'.$this->action->id.'"'?>
<?= YII::t( 'project', 'The action belongs to the controller').' "'.get_class($this).'"'?>
<?= YII::t( 'project', 'in the').' "'.$this->module->id.' '.YII::t( 'project', 'module').'.'?>
</p>
<p>
<?= YII::t( 'project', 'You may customize this page by editing').' <tt>'.__FILE__.'</tt>'?>
</p>