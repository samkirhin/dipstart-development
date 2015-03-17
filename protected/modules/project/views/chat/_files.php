<?php
///uploads/additions/${part_id}/${file_name}">${orig_name}
echo CHtml::link($data->orig_name,'/uploads/additions/'.$data->part_id.'/'.$data->file_name);