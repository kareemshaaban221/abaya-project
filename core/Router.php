<?php

namespace Core;

use Exception;

class Router {

    protected static $routes = ['get' => [], 'post' => []];

    public static function get($uri, array $action) {
        static::check($action);
        static::$routes['get'][trim($uri, '/')] = $action;
    }

    public static function post($uri, array $action) {
        static::check($action);
        static::$routes['post'][$uri] = $action;
    }

    public static function resolve($uri, $method) {
        try {
            
            $method = strtolower($method);
            $target_routes = static::$routes[$method];
            if (array_key_exists($uri, $target_routes)) {

                $controller = $target_routes[$uri][0];
                $action     = $target_routes[$uri][1];

                $controller = new $controller;
                return $method == 'post' ? $controller->$action(new Request) : $controller->$action();

            } else { // not found returned
                return view('admin.errors.404');
            }

        } catch (Exception $e) {
            // return view('admin.errors.404');
            throw $e;
            // throw new Exception('something wrong while resolving uri');
        }
    }

    private static function check($action) {
        if (count($action) != 2)
            throw new Exception('something wrong while make routes');
    }

}
