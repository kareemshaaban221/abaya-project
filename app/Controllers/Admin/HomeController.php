<?php

namespace App\Controllers\Admin;

use App\Middlewares\IsAuth;
use Core\Auth;

class HomeController {

    public function __construct() {
        middleware(IsAuth::class);
    }

    public function logout() {
        Auth::logout();
        return redirect('admin', ['done' => 'تم تسجيل الخروج.']);
    }

    public function blocked() {
        return view('admin.errors.blocked');
    }
}
