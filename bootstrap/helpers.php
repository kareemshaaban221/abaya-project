<?php

use Core\App;
use Core\Auth;
use Core\Request;
use Core\Session;

function dd($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function view($view_path, $with = []) {
    extract($with);
    require_once 'resources/views/' . str_replace('.', '/', $view_path) . '.php';
}

function config(string $group) {
    return App::get("config.$group");
}

function root_path(string $path = '') {
    return $path;
}

function asset(string $path = '') {
    return config('app.url') . '/' . "resources/assets/" . trim($path, '/');
}

function section(string $section_name = '') {
    ob_start();
    Session::set('section', $section_name);
}

function endSection() {
    $content = ob_get_clean();

    $section_name = Session::get('section');
    Session::unset('section');

    $layouts = Session::get('layouts');
    Session::unset('layouts');

    return view($layouts, [$section_name => $content]);
}

function extend(string $layouts = '') {
    Session::set('layouts', $layouts);
}

function redirect($route, $with=[]) {
    $params = "";
    foreach ($with as $key => $value) {
        $params .= "&$key=$value";
    }
    $params = trim($params, '&');
    header('Location:'. trim(config('app.url'), '/') . '/' . trim($route, '/') . '?' . $params);
    exit();
}

function middleware($middleware) {
    $is_admin_route = array_search('admin', explode('/', Request::uri()));
    if (!$middleware::handler())
        if ($is_admin_route !== false)
            return redirect(config('middleware.admin.' . $middleware::REDIRECT));
        else
            return redirect(config('middleware.website.' . $middleware::REDIRECT));
}

function route($route='') {
    return trim(config('app.url'), '/') . '/' . trim(str_replace('.', '/', $route), '/');
}

function _yield($content) {
    echo $content;
}

function auth($function) {
    return Auth::$function();
}

function now() {
    return date('Y-m-d H:i:s');
}

function request($key) {
    return (new Request)->get($key);
}

function session() {
    return Session::class;
}
