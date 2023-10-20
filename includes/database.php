<?php
if (!defined('_INCODE')) die('access denied ...');

function query($sql, $data = [], $statementStatus = false)
{
    global $conn;

    $query = false;

    try {
        $statement = $conn->prepare($sql);

        if (empty($data)) {
            $query = $statement->execute();
        } else {
            $query = $statement->execute($data);
        }
    } catch (Exception $exception) {
        require_once 'modules/errors/database.php';
    }

    if ($statementStatus && $query) {
        return $statement;
    }

    return $query;
}

function insert($table, $data = []) {
    if (empty($data)) {
        return false;
    }

    $column = implode(', ', array_keys($data));

    $placeholders = ':' . implode(', :', array_keys($data));

    $sql = "INSERT INTO $table($column) VALUES ($placeholders)";

    query($sql, $data, true);
}

function getRows($sql)
{
    $statement = query($sql, [], true);

    if (!empty($statement)) {
        return $statement->rowCount();
    }
}