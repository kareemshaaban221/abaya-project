<?php

use Core\App;
use Core\Database\QueryBuilder;

App::initialize();

App::bind('config.database', require_once 'config/database.php');
App::bind('config.app', require_once 'config/app.php');
App::bind('config.middleware', require_once 'config/middleware.php');

App::bind('db.query', QueryBuilder::getInstance());
