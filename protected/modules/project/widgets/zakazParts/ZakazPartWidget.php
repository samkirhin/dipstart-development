<?php

class ZakazPartWidget extends CWidget{
    
  public $projectId;
	public $status;
	public $item_id;
	public $record_id;
	public $status_id;
	public $_status;
	public $select;
  public $arrDataProvider;
	public static $folder;


    public function init() {
		// --- campaign
		$c_id = Campaign::getId();
		if ($c_id) {
			$folder = '/uploads/c'.$c_id.'/parts/';
		}else{
			$folder = '/uploads/additions/';
		}
		// ---
        $this->arrDataProvider = new CArrayDataProvider(
            ZakazParts::model()->with('files')->findAllByAttributes(['proj_id'=>$this->projectId])
        );
		if (!file_exists(Yii::getPathOfAlias('webroot').$folder)){
			mkdir(Yii::getPathOfAlias('webroot').$folder, 0777, true);
		}
		if (!file_exists(Yii::getPathOfAlias('webroot').$folder.'temp/')){
			mkdir(Yii::getPathOfAlias('webroot').$folder.'temp/', 0777);
		}
        if (!User::model()->isCustomer()) foreach (array_diff(scandir(Yii::getPathOfAlias('webroot').$folder.'temp/'), array('..', '.')) as $k => $v)
            $temps[array_reverse(str_getcsv(pathinfo($v,PATHINFO_FILENAME),'_'))[0]][$k]=array(
                'id'=>0,
                'part_id'=>array_reverse(str_getcsv(pathinfo($v,PATHINFO_FILENAME),'_'))[0],
                'orig_name'=>implode('_',array_slice(str_getcsv(pathinfo($v,PATHINFO_FILENAME),'_'),0,-1)).'.'.pathinfo($v,PATHINFO_EXTENSION),
                'file_name'=>Yii::app()->baseUrl.$folder.'temp/'.$v,
                'comment'=>0,
				'for_approved'=>'Must approved',
            );
        $tempdata = $this->arrDataProvider->getData();
        foreach ($tempdata as $k=>$v){
            if (isset($tempdata[$k]->files)) foreach ($tempdata[$k]->files as $fk=>$fv)
                $tempdata[$k]->files[$fk]->file_name=Yii::app()->baseUrl.$folder.$fv->part_id.'/'.$fv->file_name;
            if (isset($temps[$v->id])) $tempdata[$k]->files=array_merge($v->files,$temps[$v->id]);
        }
        $this->arrDataProvider->setData($tempdata);
    }

    public function run() {
        /*$this->widget('zii.widgets.CListView', array(
            'dataProvider' => $this->arrDataProvider,
            'itemView'=>'newview',
            'summaryText'=>'',
        ));*/
		$data = $this->arrDataProvider->getData();
		
		$records = PartStatus::model()->findAll();

		foreach ($data as $this->item_id => $item) {
			$this->status = PartStatus::model()->findByPk($item->status_id);

			$this->record_id = $item->id;
			$this->status_id = $item->status_id;
			$this->status = $this->status->status;
			
			$this->select = "
				<script type=\"text/javascript\">
					function status_changed_$this->record_id( item_id ){
						var status_id = document.getElementById('select-status-$this->record_id').value;
						var orderId = $('#order_number').text();
						$.ajax({
							type: \"POST\",
							url:'http://'+document.domain+'/project/zakazParts/status'
							, data : 'cmd=status&status_id='+status_id+'&id='+item_id+'&orderId='+orderId
							, success: function(html) {
								/*html = BackReplacePlusesFromStr(html);*/
								if (html != 'null') {
									/*alert(html);*/
								}
							}
						});
					}
				</script>";

			$this->select.= '<select name="select-status-'.$this->record_id.'" id="select-status-'.$this->record_id.'" onchange="status_changed_'.$this->record_id.'('.$this->record_id.'); return false;">';
			foreach ($records as $rec) {
				$this->select.= "<option value='$rec->id' ";
				if ($rec->id == $item->status_id) $this->select.= 'selected="selected"';
				$this->select.= ">{$rec->status}</option>";
			};	
			$this->select.= '</select>';
      
      /*print '<pre>';
      print_r ($item);
      print '</pre>';
      die;*/
      
			$this->render('newview', $item);
		}
    }
}
