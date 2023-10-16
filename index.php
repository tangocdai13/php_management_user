<?php
session_start();

require_once 'config.php';
require_once 'includes/function.php';
require_once 'includes/connect.php';
require_once 'includes/database.php';
require_once 'includes/session.php';

$modules = _MODULES_DEFAULT;
$action = _ACTION_DEFAULT;


if (!empty($_GET['modules']) && is_string($_GET['modules'])) {
    $modules = $_GET['modules'];
}

if (!empty($_GET['action']) && is_string($_GET['action'])) {
    $action = $_GET['action'];
}

$path = 'modules/'.$modules.'/'.$action.'.php';

if (file_exists($path)) {
    require $path;
} else {
    require 'modules/errors/404.php';
}

//echo _WEB_HOST_ROOT;
//echo '<br />';
//echo _WEB_HOST_TEMPLATE;