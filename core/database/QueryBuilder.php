<?php

namespace Core\Database;

use PDO;

class QueryBuilder {

    protected PDO $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public static function getInstance() {
        return new self(Connection::make());
    }

    public function execute($query, $fetch_mode = true) {
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function select($table, $cols='*', $condition=1, $fetch=false) {
        $sql = "SELECT $cols FROM `$table` WHERE $condition";
        $statment = $this->pdo->query($sql);
        return $fetch ? $statment->fetch(PDO::FETCH_ASSOC) : $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $cols, $values) {
        $sql = "INSERT INTO `$table` ($cols) VALUES ($values)";
        $this->pdo->query($sql);
        return $this->pdo->lastInsertId();
    }

    public function update($table, $sets, $condition=1) {
        $sql = "UPDATE `$table` SET $sets WHERE $condition";
        return $this->pdo->query($sql);
    }

    public function delete($table, $condition=1) {
        $sql = "DELETE FROM `$table` WHERE $condition";
        return $this->pdo->query($sql);
    }

}
