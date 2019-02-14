<?php

class Helper{

    private function __construct(){}
    
    private function __clone(){}


    public static function getHeader($title, $path = 'header'){

        $header = require_once 'includes/layout/' . $path . '.php';

        return $header;
    }

    public static function getFooter($path = 'footer'){

        $footer = require_once 'includes/layout/' . $path . '.php';

        return $footer;
    }
}

?>