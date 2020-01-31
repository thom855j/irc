<?php

class Request {

    public static function exists($type = 'post') {
        switch ($type) {
            case 'post':
                return (!empty($_POST)) ? true : false;
                break;
            case 'get':
                return (!empty($_GET)) ? true : false;
                break;
            case 'files':
                return (!empty($_FILES)) ? true : false;
                break;
            default:
                return false;
                break;
        }
    }

    public static function get($item, $info = null) {
        if (isset($_POST[$item])) {
            return $_POST[$item];
        } elseif (isset($_GET[$item])) {
            return $_GET[$item];
        } elseif (isset($_FILES[$item][$info])) {
            return $_FILES[$item][$info];
        }
        return false;
    }

}