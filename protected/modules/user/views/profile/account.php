<?php

$this->pageTitle = Yii::t('UserModule.user', 'Account');

?>

<div class="row">
    <div class="col-md-12" style="text-align:center;">
        <h3><?= Yii::t('UserModule.user', 'Account') ?></h3>
    </div>
</div>

<div class="col-md-offset-2 col-md-8">
    <table class="table">
        <tbody>
            <tr>
                <?php if (User::model()->isCustomer()): ?>

                    <th>Общая стоимость за работу</th>
                    <th>Сумма к оплате</th>
                    <th>Оплаченная сумма</th>
                </tr><tr>
                    <td><?= $project_price ?></td>
                    <td><?= $to_receive ?></td>
                    <td><?= $received ?></td>

                <?php elseif (User::model()->isAuthor()): ?>

                    <th>Сумма бюджетов за заказы</th>
                    <th>Сумма к оплате</th>
                </tr><tr>
                    <td><?= $work_price ?></td>
                    <td><?= $to_pay ?></td>

                <?php endif; ?>
            </tr>
        </tbody>
    </table>
</div>
