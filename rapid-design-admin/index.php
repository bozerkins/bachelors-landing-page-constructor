<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
    'debug' => true,
	'log.level' => \Slim\Log::DEBUG,
	'mode' => 'development',
	'templates.path' => './Templates'
));

$router = new \Core\Router($app);
$router->app->environment()->config = new \Core\Config();
$router->app->environment()->database = new \Core\Database($router->app->environment()->config);

$router->listen()->run();