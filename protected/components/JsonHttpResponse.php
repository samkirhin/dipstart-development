<?php

class JsonHttpResponse extends BaseHttpResponse implements IHttpResponse {

    protected $_messages = array(
        'common' => array(
            'error' => array(
                self::STATUS_FAILED => 'Error'
            ),
            'upload' => array(
                self::STATUS_FAILED => 'File upload error'
            )
        )
            
    );

    public function send() {
        $result = array(
            'status'  => $this->_status,
            'message' => $this->_message
        );

        if (!is_null($this->_data))
            $result['data'] = $this->_data;

        header('Content-Type: application/json');
        echo CJSON::encode($result);

        Yii::app()->end();
    }

    public static function sendForbidden($message = null) {
        header('Content-Type: application/json');
        echo CJSON::encode(array(
            'status' => self::STATUS_FORBIDDEN,
            'message' => (!is_null($message)) ? $message : 'Access denied'
        ));
        Yii::app()->end();
    }

}