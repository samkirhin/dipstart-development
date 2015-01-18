<?php

class BaseHttpRequest extends CHttpRequest {

    public function getUrlReferrer() {
        $referrer = parent::getUrlReferrer();
        $host = UrlHelper::getHost($referrer);

        if ($host === $this->getServerName()) {
            return $referrer;
        } else {
            return UrlHelper::createAbsoluteUrl('/shop');
        }


    }

} 