<?php

class ZakazPartWidget extends CWidget{
    
    public $projectId;
    public $userType='1';
    public $action = 'newview';
    
    
    public function init() {
        $dataProvider=new CActiveDataProvider('ZakazParts',array(
            'criteria'=>array(
                'condition'=>'proj_id='.$this->projectId,
                'with'=>array(
                    'files' => array(
                        'together' => true,
                    ),
                )
            ),
        ));
        $arrDataProvider=new CArrayDataProvider(
            ZakazParts::model()->with('files')->findAllByAttributes(['proj_id'=>$this->projectId])
        );
        $temps=array_diff(scandir(Yii::getPathOfAlias('webroot').'/uploads/additions/temp'), array('..', '.'));
        foreach ($temps as $k=>$v)
            $temps[str_getcsv(pathinfo($v,PATHINFO_FILENAME),'_')[1]][$k]=array(
                'id'=>0,
                'part_id'=>str_getcsv(pathinfo($v,PATHINFO_FILENAME),'_')[1],
                'orig_name'=>str_getcsv(pathinfo($v,PATHINFO_FILENAME),'_')[0].'.'.pathinfo($v,PATHINFO_EXTENSION),
                'file_name'=>Yii::app()->baseUrl.'/uploads/additions/temp/'.$v,
                'comment'=>0,
            );
        $tempdata=$arrDataProvider->getData();
        //echo '<pre>';
        foreach ($tempdata as $k=>$v){
            if (isset($tempdata[$k]->files)) foreach ($tempdata[$k]->files as $fk=>$fv)
                $tempdata[$k]->files[$fk]->file_name=Yii::app()->baseUrl.'/uploads/additions/'.$fv->part_id.'/'.$fv->file_name;
            if (isset($temps[$v->id])) $tempdata[$k]->files=array_merge($v->files,$temps[$v->id]);
            //print_r($tempdata[$k]);
        }
        $arrDataProvider->setData($tempdata);
        //echo '</pre>';
        //die;
        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$arrDataProvider,
            'itemView'=>'newview',
            'summaryText'=>'',
        ));
    }
}
