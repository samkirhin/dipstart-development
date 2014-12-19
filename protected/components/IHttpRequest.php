<?php

interface IHttpRequest {

    public function getParam($name, $defaultValue = null);

    public function isParam($name);

}