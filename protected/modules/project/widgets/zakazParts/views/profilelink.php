<?php if($params['isLink']): ?>
	<a href="<?php echo Yii::app()->createUrl("user/user/view",array("id"=>$params['userId'])); ?>" id="<?php echo $params['id']; ?>"><?php echo $params['name']; ?></a>
<?php else: ?>
	<?php echo $params['name']; ?>
<?php endif; ?>