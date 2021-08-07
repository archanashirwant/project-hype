<?php
include 'config/config.php';


session_start();

spl_autoload_register('loadClasses');





function loadClasses($className)
{

    if(file_exists(CONTROLLER_PATH.$className.'.php' ) ){
        set_include_path(CONTROLLER_PATH);
        spl_autoload($className);
    }
    elseif( file_exists(MODEL_PATH.$className.'.php' ) ){
        set_include_path(MODEL_PATH);
        spl_autoload($className);
    }elseif( file_exists(SYSTEM_PATH.$className.'.php' ) ){
        set_include_path(SYSTEM_PATH);
        spl_autoload($className);
    }
}

$router = new RouterController();
$router->process($_SERVER['REQUEST_URI']);

$router->renderView();

?>
