<?php
require __DIR__ . "/vendor/autoload.php";

$app = new \Silex\Application();

$app->register(new \Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver' => 'pdo_mysql',
    ],
    'repository' => function ($app) {
        return new \Geolocation\Infrastructure\Repository\IpRepository($app['db']);
    }
]);

$app->register(new \Silex\Provider\ServiceControllerServiceProvider(), [
    'controller' => function ($app) {
        return new \Geolocation\Http\Controller\IpController($app['repository']);
    }
]);

$app->register(new \Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/views'
]);

$app->get('/','controller:indexAction');
$app->post('/ip', 'controller:ipAction');