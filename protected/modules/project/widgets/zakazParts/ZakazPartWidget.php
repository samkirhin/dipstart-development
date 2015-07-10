<?php

class ZakazPartWidget extends CWidget{
    
    public $projectId;
    public $arrDataProvider;

    public function init() {
        $this->arrDataProvider = new CArrayDataProvider(
            ZakazParts::model()->with('files')->findAllByAttributes(['proj_id'=>$this->projectId])
        );

        if (!User::model()->isCustomer()) foreach (array_diff(scandir(Yii::getPathOfAlias('webroot') . '/uploads/additions/temp'), array('..', '.')) as $k => $v)
            $temps[array_reverse(str_getcsv(pathinfo($v,PATHINFO_FILENAME),'_'))[0]][$k]=array(
                'id'=>0,
                'part_id'=>array_reverse(str_getcsv(pathinfo($v,PATHINFO_FILENAME),'_'))[0],
                'orig_name'=>implode('_',array_slice(str_getcsv(pathinfo($v,PATHINFO_FILENAME),'_'),0,-1)).'.'.pathinfo($v,PATHINFO_EXTENSION),
                'file_name'=>Yii::app()->baseUrl.'/uploads/additions/temp/'.$v,
                'comment'=>0,
            );
        $tempdata = $this->arrDataProvider->getData();
        foreach ($tempdata as $k=>$v){
            if (isset($tempdata[$k]->files)) foreach ($tempdata[$k]->files as $fk=>$fv)
                $tempdata[$k]->files[$fk]->file_name=Yii::app()->baseUrl.'/uploads/additions/'.$fv->part_id.'/'.$fv->file_name;
            if (isset($temps[$v->id])) $tempdata[$k]->files=array_merge($v->files,$temps[$v->id]);
        }
        $this->arrDataProvider->setData($tempdata);
    }

    public function run()
    {
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $this->arrDataProvider,
            'itemView'=>'newview',
            'summaryText'=>'',
        ));
    }
}
