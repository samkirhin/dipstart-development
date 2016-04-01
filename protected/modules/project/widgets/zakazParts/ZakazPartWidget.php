<?php

class ZakazPartWidget extends CWidget{
    public $number;
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
        $this->arrDataProvider = new CArrayDataProvider(
            ZakazParts::model()->with('files')->findAllByAttributes(['proj_id'=>$this->projectId])
        );
    }

    public function run() {
        /*$this->widget('zii.widgets.CListView', array(
            'dataProvider' => $this->arrDataProvider,
            'itemView'=>'newview',
            'summaryText'=>'',
        ));*/
		$data = $this->arrDataProvider->getData();
		$records = PartStatus::model()->findAll();
		$number = 0;

		foreach ($data as $this->item_id => $item) {
			$number++;
			if (User::model()->isCustomer() && $item->status_id == 4)
				$this->status = ProjectModule::t('Approved by me');
			else {
				$this->status = PartStatus::model()->findByPk($item->status_id);
				$this->status = $this->status->status;
			}
			$this->record_id = $item->id;
			$this->status_id = $item->status_id;
			
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
      
			if(Yii::app()->user->isGuest || (User::model()->isAuthor() && !User::model()->isExecutor($item->proj_id))){
				$this->number = $number;
				$this->render('index', $item);
			}else{
				$this->render('newview', $item);
			}
		}
    }
}
