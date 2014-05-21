<?php
session_cache_limiter(FALSE);
session_start();

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
    'debug' => TRUE,
	'log.level' => \Slim\Log::DEBUG,
	'mode' => 'development',
	'templates.path' => './Templates'
));

$router = new \Core\Router($app);
$router->app->environment()->config = new \Core\Config();
$router->app->environment()->database = new \Core\Database($router->app->environment()->config);

$router->listen()->run();