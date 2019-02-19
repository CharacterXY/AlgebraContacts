<?php

class Session{

    public static function all(){
        return $_SESSION;   
    }

    public static function exists($key){
        return isset($_SESSION[$key]) ? true : false ;  
    }

    public static function put($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        return $_SESSION[$key];
    }

    public static function delete($key){
        if (self::exists($key)) {
            unset($_SESSION[$key]);
        }
    }

    public static function flash($key, $value = ''){
        if (self::exists($key)) {
            $message = self::get($key);
            self::delete($key);
            return $message;
        } else {
            self::put($key, $value);
        }
        return '';
    }
}


?>