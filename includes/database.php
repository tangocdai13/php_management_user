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
        echo $exception->getMessage();

        echo 'File: '.$exception->getFile(). ' -Line: '.$exception->getLine();
    }

    if ($statementStatus && $query) {
        return $statement;
    }

    return $query;
}

function getRows($sql)
{
    $statement = query($sql, [], true);

    if (!empty($statement)) {
        return $statement->rowCount();
    }
}