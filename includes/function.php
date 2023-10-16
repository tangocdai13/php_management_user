<?php
if (!defined('_INCODE')) die('access denied ...');

function layout($layout = 'header', $data = []) {
    if (file_exists('templates/layouts/login/'.$layout.'.php')) {
        require_once 'templates/layouts/login/'.$layout.'.php';
    }
}