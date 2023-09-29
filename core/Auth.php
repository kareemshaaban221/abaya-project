<?php

namespace Core;

class Auth {
    public static function check() {
        return Session::has('user');
    }
    public static function user() {
        return Session::get('user');
    }

    public static function userUpdate($user) {
        Session::set('user', $user);
        return $user;
    }

    public static function user_type() {
        return Session::has('user_type') ?
            Session::get('user_type') : null;
    }

    public static function login(array $user) {
        Session::set('user', $user);
        Session::set('user_type', $user['user_type']);
        return $user;
    }

    public static function logout() {
        Session::unset('user');
        Session::unset('cart');
        Session::set('user_type', 'guest');
    }
}
