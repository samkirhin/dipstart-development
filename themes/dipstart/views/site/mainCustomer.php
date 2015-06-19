<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/custom.css');?>
   <div class="row" style="padding-bottom: 20px;">
            <div class="col-xs-3"><a class="btn btn-default btn-block btn-adminka" href="#">Личный кабинет</a></div>

            <div class="col-xs-3"><a class="btn btn-default btn-block btn-adminka" href="<?= $this->createUrl('/user/profile/account') ?>">Личный счет</a></div>
    
            <div class="col-xs-3"><a class="btn btn-default btn-block btn-adminka" href="<?= $this->createUrl('/user/profile/edit') ?>">Профиль</a></div>

            <div class="col-xs-3"><a class="btn btn-default btn-block btn-adminka" href="/index.php?r=project/zakaz/create">Создать заказ</a></div>

            <div class="col-xs-3"><a class="btn btn-default btn-block btn-adminka" href="<?= $this->createUrl('/project/zakaz/customerOrderList') ?>">Мои заказы</a></div>
    </div>
       
