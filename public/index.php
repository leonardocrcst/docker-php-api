<?php

use DI\Container;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$routes = require_once __DIR__ . '/../config/routes.php';
$inject = require_once __DIR__ . '/../config/inject.php';

$container = new Container();
$inject($container);

Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env.development')
    ->load();

AppFactory::setContainer($container);
$app = AppFactory::create();
$routes($app);
$app->run();