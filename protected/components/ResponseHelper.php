<?php

class ResponseHelper {

    public static function JsonReturnSuccess($data, $message) {
        echo CJSON::encode(array('status' => 1, 'data' => $data, 'message' => $message));
    }

    public static function JsonReturnError($data, $message) {
         echo CJSON::encode(array('status' => 0, 'data' => $data, 'message' => $message));      
    }
}
