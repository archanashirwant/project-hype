<?php

//get the site url
$siteURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https//' : 'http://';
if ($_SERVER["SERVER_PORT"] != "80") {
  $siteURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
  $siteURL .= $_SERVER["SERVER_NAME"].rtrim(dirname($_SERVER['PHP_SELF']), '/\\').'/';
}


define('ROOTPATH', dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);
define('SITE', $siteURL);

define('MODEL_PATH', ROOTPATH.'model/');
define('CONTROLLER_PATH', ROOTPATH.'controller/');
define('VIEW_PATH', ROOTPATH.'view/');
define('SYSTEM_PATH', ROOTPATH.'system/');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'my_db');
?>