<?php

use App\Controllers\Website\Auth\LoginController;
use App\Controllers\Website\Auth\PasswordForgetController;
use App\Controllers\Website\Auth\RegisterController;
use Core\Router;

Router::get('login', [LoginController::class, 'index']);
Router::post('login', [LoginController::class, 'login']);
Router::get('register', [RegisterController::class, 'index']);
Router::post('register', [RegisterController::class, 'register']);
Router::get('password/forget', [PasswordForgetController::class, 'index']);
Router::post('password/forget', [PasswordForgetController::class, 'checkEmail']);
Router::post('password/reset', [PasswordForgetController::class, 'reset']);
