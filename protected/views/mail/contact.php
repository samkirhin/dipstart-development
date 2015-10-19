<?php
/**
 * Created by PhpStorm.
 * User: coolfire
 * Date: 20.03.15
 * Time: 15:01
 */
?>
<p><?= Yii::t('site','Message from').' '.$name . ': ' . $message ?></p>

<p><?= Yii::t('site','You may change the content of this page by modifying the following two files:') ?></p>
<ul>
    <li><?= Yii::t('site','View file').': <tt>'.__FILE__ ?></tt></li>
    <li><?= Yii::t('site','Layout file').': <tt>'.$this->getLayoutFile('mail')?></tt></li>
</ul>
