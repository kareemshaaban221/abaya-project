<?php

namespace Core;

class Request {

    protected $request;

    public function __construct() {
        $this->request = $_REQUEST;
    }

    public function get($key) {
        return isset($this->request[$key]) ? $this->request[$key] : null;
    }

    public function has($key) {
        return isset($this->request[$key]);
    }

    public function all() {
        return $this->request;
    }

    public function files() {
        return $_FILES;
    }

    public function file($key) {
        return isset($_FILES[$key]) && $_FILES[$key]['size'] > 0 ? $_FILES[$key] : null;
    }

    /**
     * @return array|bool
     */
    public function validate($input_rules = []) {
        $errors = [];
        foreach ($input_rules as $input => $rules) {
            $rules = explode('|', $rules);
            foreach ($rules as $rule) {
                $isNotValid = Validator::condition($rule);
                if ($isNotValid($input)) {
                    $errors[$input] = Validator::message($rule, $input);
                }
            }
        }

        if (count($errors) != 0)
            return $errors;
        else
            return true;
    }

    public static function uri() {
        $paths = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
        array_shift($paths);
        return implode('/', $paths);
    }

    public static function method() {
        return $_SERVER['REQUEST_METHOD'];
    }
}
