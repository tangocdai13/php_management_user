<?php
if (!defined('_INCODE')) die('access denied ...');

$token = getBody()['token'];
if (!empty($token)) {
    $tokenQuery = firstRaw("SELECT id FROM users WHERE activeToken = '$token'");
    if (!empty($tokenQuery['id'])) {
        $userId = $tokenQuery['id'];
    }

    $dataUpdate = [
        'status' => 1,
        'activeToken' => null,
    ];

    if (update('users', $dataUpdate, "id= $userId")) {
        header("Location: ?modules=auth&action=login");
    }

}