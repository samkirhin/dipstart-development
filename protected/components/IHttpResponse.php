<?php


interface IHttpResponse {

    public static function sendForbidden($message = null);

    public function __construct($status = self::STATUS_SUCCESS, $data = null);

    public function send();

    public function setAnswer($status, $message, $data = null);

    public function setData($data);

    public function setMessage($message);

    public function setStatus($status);

}