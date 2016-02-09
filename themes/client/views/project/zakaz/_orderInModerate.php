<?php
if(User::model()->isCustomer()) {
	echo '<h2>'.ProjectModule::t('Your order for moderation. Please wait for the processing of your order manager.').'</h2>';
} else {
	echo '<h2>'.ProjectModule::t('This order is awaiting moderation.').'</h2>';
}