<?php
if (!defined('_INCODE')) die('access denied ...');

function setSession($key, $value) {
    if (!empty(session_id())) {
        $_SESSION[$key] = $value;
        return true;
    }

    return false;
}

function getSession($key = '') {
    if (empty($key)) {
        return $_SESSION;
    } else {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    return false;
}

function removeSession($key = '') {
    if (empty($key)) {
        session_destroy();
        return true;
    } else {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            return true;
        }
    }

    return false;
}

function setFlashSession($key, $value) {
    $key = 'flash_'.$key;

    setSession($key, $value);
}

function getFlashSession($key) {
    $key = 'flash_'.$key;

    if ($data = getSession($key)) {
        removeSession($key);
        return $data;
    }
}