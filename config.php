<?php

const _MODULES_DEFAULT = 'home';
const _ACTION_DEFAULT = 'list';

const _INCODE = 'incode';

//Thiết lập host
define('_WEB_HOST_ROOT', 'http://'.$_SERVER['HTTP_HOST'].'/suntech/php/php_management_user');

define('_WEB_HOST_TEMPLATE', _WEB_HOST_ROOT.'/templates');

//Thiết lập path
define('_WEB_PATH_ROOT', __DIR__);

define('_WEB_PATH_TEMPLATE', _WEB_PATH_ROOT.'/templates');

//Thiết lập kết nối Database
const _HOST = 'localhost';
const _USER = 'root';
const _PASS = 'root';

const _DB = 'php_management_user';

const _DRIVER = 'mysql';