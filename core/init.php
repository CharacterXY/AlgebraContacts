<?php

session_start();
//session_regenerate_id();

spl_autoload_register(function($class){
    require_once 'classes/' . $class . '.php';
});

error_reporting( Config::get('app')['error_reporting']  );
$displayErrors = Config::get('app')['display_errors'];
ini_set('display_errors', $displayErrors);
ini_set('display_startup_errors', $displayErrors);

require_once 'functions/sanitize.php';

?>