<?php

namespace App\Middlewares;

use Core\Session;

class IsGuest {

    public const REDIRECT = 'home';

    public static function handler() {
        if (!Session::has('user_type'))
            Session::set('user_type', 'guest');

        return Session::get('user_type') == 'guest';
    }

}
