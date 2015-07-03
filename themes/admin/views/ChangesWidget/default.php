<?php
/* @var $this CWidget */
/* @var $user User */
/* @var $changes ProjectChanges */
?>


<div class="row zero-edge">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="partStatus"></div>
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#collapseEdits<?php echo $data['id']; ?>"><?php echo $data['title']; ?></a>
                </h4>
            </div>

            <div id="collapseEdits<?php echo $data['id']; ?>" class="panel-collapse collapse in">
                <div class="panel-body">
                    <p>
                        <?php echo $data['date']; ?>
                    </p>
                    <div id="list_files">
                    <?php
                        $this->widget('zii.widgets.CListView', array(
                            'dataProvider'=>$changes,
                            'itemView'=>'_list',
                            'summaryCssClass'=>'hidden',
                            'emptyText'=>'',
                        ));
                        ?>
                    </div>
                    <div class="form">
                        <div id="errors-block"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

