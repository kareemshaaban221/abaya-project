<?php

namespace App\Models;

use Core\App;
use Core\Database\QueryBuilder;

abstract class Model {

    protected string $table;
    protected QueryBuilder $queryBuilder;

    protected function __construct(string $table) {
        $this->table = $table;
        $this->queryBuilder = App::get('db.query');
    }

    public static function query(): Model {
        $class = get_called_class();
        return new $class;
    }

    public function execute($query, $fetch_mode = true) {
        return $this->queryBuilder->execute($query, $fetch_mode);
    }

    public function selectAll() {
        return $this->queryBuilder->select($this->table);
    }

    public function find($id) {
        return $this->queryBuilder->select(
            table       : $this->table,
            condition   : "id=$id",
            fetch       : true
        );
    }

    public function where($first, $op, $second) {
        return $this->queryBuilder->select(
            table       : $this->table,
            condition   : "`$first` $op $second"
        );
    }

    public function whereIn($col, $values) {
        return $this->queryBuilder->select(
            table       : $this->table,
            condition   : "`$col` IN (" . implode(', ', $values) . ")",
        );
    }

    public function whereRaw($condition=1) {
        return $this->queryBuilder->select(
            table       : $this->table,
            condition   : $condition
        );
    }

    public function destroyWhere($first, $op, $second) {
        return $this->queryBuilder->delete(
            table       : $this->table,
            condition   : "`$first` $op $second"
        );
    }

    public function destroy($id) {
        return $this->queryBuilder->delete(
            table       : $this->table,
            condition   : "id=$id"
        );
    }

    public function create(array $data) {
        $data['created_at'] = "'" . now() . "'";
        $data['updated_at'] = "'" . now() . "'";
        $cols  = implode(',', array_keys($data));
        $values = implode(',', array_values($data));
        return $this->queryBuilder->insert(
            table   : $this->table,
            cols    : $cols,
            values  : $values
        );
    }

    public function update($id, array $data) {
        $data['updated_at'] = "'" . now() . "'";
        $sets = $this->prepareSets($data);
        return $this->queryBuilder->update(
            table       : $this->table,
            sets        : $sets,
            condition   : "id=$id"
        );
    }

    private function prepareSets($data) {
        $sets = '';
        $i = 0;
        $count = count($data);
        foreach ($data as $col => $value) {
            if ($i == $count - 1)
                $sets .= "`$col`=" . $value ?? 'NULL';
            else
                $sets .= "`$col`=" . ($value ?? 'NULL') . ", ";
            $i++;
        }
        return $sets;
    }

}
