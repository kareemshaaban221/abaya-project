<?php

use App\Controllers\Admin\LoginController;
use App\Controllers\Admin\PasswordForgetController;
use App\Controllers\Admin\RegisterController;
use Core\Router;

Router::get('admin/', [LoginController::class, 'index']);
Router::get('admin/login', [LoginController::class, 'index']);
Router::post('admin/login', [LoginController::class, 'login']);
Router::get('admin/register', [RegisterController::class, 'index']);
Router::post('admin/register', [RegisterController::class, 'register']);
Router::get('admin/password/forget', [PasswordForgetController::class, 'index']);
Router::post('admin/password/forget', [PasswordForgetController::class, 'checkEmail']);
Router::post('admin/password/reset', [PasswordForgetController::class, 'reset']);
