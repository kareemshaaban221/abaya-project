<?php

namespace Core\Database;

use Core\App;
use PDO;
use PDOException;

class Connection {

    public static function make() {
        try {

            $config     = config('database');

            $dsn        = static::prepareDSN($config);
            $username   = $config['username'];
            $password   = $config['password'];

            App::bind('db.connection', new PDO($dsn, $username, $password));

            return App::get('db.connection');

        } catch (PDOException $e) {

            die( $e->getMessage() );

        }
    }

    private static function prepareDSN($config) {
        return $config['type'] . ':host=' . $config['host'] . ';dbname=' . $config['name'];
    }

}
