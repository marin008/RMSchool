<?php
function dajGreske($show = false) {
       error_reporting(E_ALL);
       ini_set('display_errors',$show);
       ini_set('log_errors', !$show);
       ini_set('error_log', './php_errors.log');
}
dajGreske(true);

setlocale(LC_ALL, 'hr_HR.UTF-8');
date_default_timezone_set('Europe/Zagreb');

// konstante
define('TEMPLATE_LANG', 'en');

define('DS', DIRECTORY_SEPARATOR); 
define('PATH_APP', dirname(__FILE__));
define('PATH_PHP', PATH_APP . DS . 'inc');
define('PATH_TPL', PATH_APP . DS . 'template');
define('PATH_PAGE', PATH_TPL . DS . 'page');
define('PATH_COMMON', PATH_TPL . DS . 'common');
define('PATH_SEGMENT', PATH_TPL . DS . 'segment');
define('PATH_LANG', PATH_TPL . DS . 'lang');

//define('BASE_URL', trim((isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . (($_SERVER["SERVER_PORT"] != "80") ? ":" . $_SERVER["SERVER_PORT"] : '') . pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME), '/'));

define('BASE_URL', trim((isset($_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : (isset($_SERVER['HTTPS']) ? 'https' : 'http')) . '://' . $_SERVER['HTTP_HOST'] . (($_SERVER["SERVER_PORT"] != "80") ? ":" . $_SERVER["SERVER_PORT"] : '') . pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME), DS));


include(PATH_PHP . '/functions.php');
include(PATH_PHP . '/Site.php');

Site::init();

