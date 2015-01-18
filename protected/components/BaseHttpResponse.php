<?php

abstract class  BaseHttpResponse {

    const STATUS_SUCCESS          = 10;

    const STATUS_NOT_MODIFIED     = 11;

    const STATUS_ALREADY_DONE     = 12;

    const STATUS_INCORRECT_FORMAT = 20;

    const STATUS_FAILED           = 30;

    const STATUS_FORBIDDEN        = 31;

    const STATUS_NOT_FOUND        = 32;

    const STATUS_BUSY             = 33;

    const STATUS_LOGIN_USER_NAME_ALREADY_EXISTS = 4001;

    const STATUS_LOGIN_MAIL_ALREADY_EXISTS      = 4002;

    const STATUS_WELCOME_BACK                   = 4003;

    const STATUS_USER_CANT_BE_UNFOLLOW          = 4004;

    const STATUS_CHOOSE_MAIL                    = 4005;

    protected $_status = self::STATUS_SUCCESS;

    protected $_message = '';

    protected $_messages = array();

    protected $_data = null;

    public function __construct($status = self::STATUS_SUCCESS, $data = null) {
        $this->_status = $status;
        $this->_data = $data;
    }

    public function setStatus($status) {
        $this->_status = $status;
    }

    public function setMessage($message) {
        if (is_array($message))
            $this->_message = isset($this->_messages[$message[0]][$message[1]][$message[2]]) ? $this->_messages[$message[0]][$message[1]][$message[2]] : null;
        else $this->_message = $message;
    }

    public function setAnswer($status, $message, $data = null) {
        $this->setStatus($status);
        $this->setMessage($message);
    }

    public function setData($array) {
        $this->_data = $array;
    }

}