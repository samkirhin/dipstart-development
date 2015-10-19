<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<?php if(0):?>
<h2><?= Yii::t('project', 'Error').' '.$code; ?></h2>
<?php endif; ?>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>