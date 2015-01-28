<?php

$this->pageTitle = Yii::t('UserModule.user', 'Account');

?>

<div>
    <h1><?= Yii::t('UserModule.user', 'Account') ?></h1>
</div>

<div>
    
    <?php if (User::model()->isCustomer()): ?>
    
        Общая стоимость за работу <?= $project_price ?> <br>
        Сумма к оплате <?= $to_receive ?> <br>
        Оплаченная сумма <?= $received ?>
            
    <?php elseif (User::model()->isAuthor()): ?>
        
        Сумма бюджетов за заказы <?= $work_price ?> <br>
        Сумма к оплате <?= $to_pay ?>
            
    <?php endif; ?>
        
</div>