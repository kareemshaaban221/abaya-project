<?php

ini_set('file_uploads', 'On');
ini_set('post_max_size', '100M');
ini_set('upload_max_filesize', '100M');

use Core\Request;
use Core\Router;
use Core\Session;

require_once __DIR__ . '/vendor/autoload.php';

Session::initialize();

require_once __DIR__ . '/bootstrap/bootstrap.php';

Router::resolve(
    Request::uri(),
    Request::method()
);
