<?php

namespace Core;

class Session {

    public static function initialize() {
        session_start();
        if (!Auth::check())
            Session::set('user_type', 'guest');
    }

    public static function has($key): bool {
        return isset($_SESSION[$key]);
    }

    public static function get($key): mixed {
        if (self::has($key))
            return $_SESSION[$key];
        else
            return null;
    }

    public static function set($key, $value): bool {
        $_SESSION[$key] = $value;
        return true;
    }

    public static function unset($key): bool {
        if (self::has($key)) {
            unset($_SESSION[$key]);
            return true;
        }
        else
            return false;
    }

    public static function clear(): bool {
        $_SESSION = [];
        return true;
    }

    public static function all(): array {
        return $_SESSION;
    }
}
