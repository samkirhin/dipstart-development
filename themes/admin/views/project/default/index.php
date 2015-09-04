<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
	<?=Yii::t('site', 'This is the view content for action "{action}".
The action belongs to the controller "{controller}"
in the "{module}" module.' ,
		array('{action}' => $this->action->id, '{controller}' => get_class($this), '{module}' => $this->module->id ))?>

</p>
<p>
<?=Yii::t('site', 'You may customize this page by editing <tt>{file}</tt>', array('{file}' => __FILE__))?>
</p>