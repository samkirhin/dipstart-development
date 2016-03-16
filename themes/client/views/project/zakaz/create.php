<?php
Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/reset.css');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/custom.css');

/* @var $this ZakazController */
/* @var $model Zakaz */
/* @var $form CActiveForm */
$c_id = Company::getId();
$url = '/uploads/c'.$c_id.'/temp/'.$model->unixtime.'/';
$uploaded_files = $model->generateMaterialsList($url);
$upload_params = array('unixtime' => $model->unixtime);

$this->renderPartial('/zakaz/_form', array(	'model' => $model,
											'upload_params' => $upload_params,
											'uploaded_files' => $uploaded_files,
											'isGuest' => $isGuest,
											'user' => $user));
?>
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