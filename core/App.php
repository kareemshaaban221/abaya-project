<?php

namespace Core;

use Exception;

class App {

    protected static $app = [];

    public static function initialize() {
        require_once 'bootstrap/helpers.php';
        require_once 'routes/web.php';
    }

    public static function bind($key, $value) {
        try {

            $keys = explode('.', $key);
            $app = &static::$app;
            foreach ($keys as $key)
                $app = &$app[$key];
            $app = $value;

        } catch (Exception $e) {

            dd($e->getMessage());

        }
    }

    public static function get($key) {
        try {

            $keys = explode('.', $key);
            $value = static::$app;
            foreach ($keys as $key)
                $value = $value[$key];
            return $value;

        } catch (Exception $e) {

            dd($e->getMessage());

        }
    }

}
