<?php

use App\Controllers\Website\HomeController;
use Core\Router;

Router::get('', [HomeController::class, 'index']);
Router::get('home', [HomeController::class, 'index']);
Router::get('farmers', [HomeController::class, 'farmers']);
Router::get('products', [HomeController::class, 'products']);
