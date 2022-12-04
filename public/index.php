<?php

use Slim\Factory\AppFactory;

require_once dirname(__FILE__, 2) . '/vendor/autoload.php';

$app = AppFactory::create();

$app->setBasePath(app('site.basePath', default: ''));

$webRoutes = require_once paths('routes') . '/web.php';

$webRoutes($app);

$app->run();
