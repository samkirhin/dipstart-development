<?php
Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/reset.css');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/custom.css');

/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $form CActiveForm */
if ($new) {
$c_id = Company::getId();
$url = '/uploads/c'.$c_id.'/temp/'.$model->unixtime.'/';
$uploaded_files = $model->generateMaterialsList($url, true);
$upload_params = array('unixtime' => $model->unixtime);

$this->renderPartial('/zakaz/_form', array(	'model' => $model,
											'upload_params' => $upload_params,
											'uploaded_files' => $uploaded_files,
											'isGuest' => $isGuest,
											'user' => $user));
} elseif(User::model()->isCustomer()) {
	echo Company::getAgreement().'<br>';
	echo CHtml::button('Да, я согласен',array('submit' => array('/project/chat','orderId' => $model->id),'class'=>'btn btn-primary')).'&nbsp; &nbsp; &nbsp;';
	echo CHtml::button('Нет, я хочу другие условия',array('id' => 'not-accept-btn', 'message' => $agreementNotAccepted, 'template' => $messageForCustomer, 'href' => Yii::app()->createUrl('/project/chat', array('orderId'=>$model->id)),'class'=>'btn btn-primary'));
}
?>

<?php if (!$new && User::model()->isCustomer()) : ?>
<script>
	$('#not-accept-btn').click(function(){
		$.post(
			$(this).attr('href'),
			{
				ProjectMessages : {recipient: "manager", message : $(this).attr('message')}
			}).done(function(){
			alert($('#not-accept-btn').attr('template'));
			$(location).attr('href',$('#not-accept-btn').attr('href'));
		});
	});
</script>
<?php endif; ?>
<!--<script>
    /*Remove attachment file*/
    function removeFile(obj){
        if (confirm("<?php echo Yii::t('site', 'Are you sure you want to delete this item?');?>")) {
            var data=$(obj).data();
            $.post('/project/zakaz/apiRenameFile?unixtime=<?php echo $model->unixtime; ?>', JSON.stringify({
                'data': data
            }), function (response) {
                if (response.data){
                    obj.remove();
                    $('#'+data.link).remove();
                }
            }, 'json');
    }}/*END Remove attachment file*/
</script>-->