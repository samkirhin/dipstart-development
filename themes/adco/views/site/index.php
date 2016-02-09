<a href="/user/login"><?=Yii::t('site', 'LogIn')?></a><br />
<?php
if($_SERVER['SERVER_NAME']=='programmarius.admintrix.com' && Campaign::getFrontPage()) $this->redirect(Campaign::getFrontPage());

