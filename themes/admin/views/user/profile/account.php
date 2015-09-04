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

                    <th> <?= Yii::t('UserModule.user', 'The total cost for the work') ?> </th>
                    <th><?= Yii::t('UserModule.user', 'Payment amount') ?></th>
                    <th><?= Yii::t('UserModule.user', 'the amount paid') ?></th>
                </tr><tr>
                    <td><?= $project_price ?></td>
                    <td><?= $to_receive ?></td>
                    <td><?= $received ?></td>

                <?php elseif (User::model()->isAuthor()): ?>

                    <th><?= Yii::t('UserModule.user', 'The sum of the budgets for orders') ?></th>
                    <th><?= Yii::t('UserModule.user', 'Payment amount') ?></th>
                </tr><tr>
                    <td><?= $work_price ?></td>
                    <td><?= $to_pay ?></td>

                <?php endif; ?>
            </tr>
        </tbody>
    </table>
</div>
