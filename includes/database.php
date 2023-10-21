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

function firstRaw($sql, $data = [])
{
    $statement = query($sql, $data, true);

    if (!empty($statement)) {
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
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

function update($table, $data, $condition, $conditionData = [])
{
    if (empty($data)) return false;

    $setValue = [];
    $setData = [];

    foreach ($data as $key => $value) {
        $setValue[] = "$key = :$key";
        $setData[":$key"] = $value;
    }

    $setClause = implode(', ', $setValue);

    $conditionClause = '';

    if (!empty($condition)) {
        $conditionClause = "WHERE $condition";
    }

    $sql = "UPDATE $table SET $setClause $conditionClause";

    $mergeData = array_merge($setData, $conditionData);

    return query($sql, $mergeData, true);
}

function getRows($sql)
{
    $statement = query($sql, [], true);

    if (!empty($statement)) {
        return $statement->rowCount();
    }
}