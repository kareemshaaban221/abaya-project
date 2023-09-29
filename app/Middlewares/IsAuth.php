<?php

namespace App\Middlewares;

use Core\Auth;
use Core\Session;

class IsAuth {

    public const REDIRECT = 'login';

    public static function handler() {
        return Auth::check();
    }

}
