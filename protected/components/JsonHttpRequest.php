<?php

/**
 * Class JsonHttpRequest
 */
class JsonHttpRequest extends BaseHttpRequest implements IHttpRequest {

    private $_params = array();

    private function parseParams() {
        $this->_params = CJSON::decode($this->getRawBody());
    }

    /**
     * Returns attribute of recieved JSON object
     * @param string $name Attribute name
     * @param null $defaultValue Default attribute value
     * @return mixed Attribute value
     */
    public function getParam($name, $defaultValue = null) {
        return isset($this->_params[$name]) ? $this->_params[$name] : $defaultValue;
    }

    public function isParam($name) {
        return is_array($this->_params) && array_key_exists($name, $this->_params);
    }

    public function init() {
        parent::init();
        $this->parseParams();
    }

}