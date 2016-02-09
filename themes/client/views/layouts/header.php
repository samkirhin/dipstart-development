<?php $company = Campaign::getCompany(); ?>
    <div class="row">
		<?php if(($company->logo) or ($company->header)) {?>
        <div class="logo col-xs-12 col-sm-12 col-md-3">
            <a href="/">
                <?php if($company->logo) echo CHtml::image(Yii::app()->getBaseUrl(/*true*/).'/'.$company->getFilesPath().'/'.$company->logo, 'logo');?>
            </a>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 header-text">
			<?php if($company->header) echo '<p>'.$company->header.'</p>';?>
        </div>
		<?php } ?>
		<div id="control-menu">
			<? $this->widget('application.extensions.booster.widgets.TbMenu',array(
				'items'=> $this->menu,
				'type'=>'tabs',
				'htmlOptions'=>array('class'=>'userMenu'),
			));
			?>
		</div>
    </div>