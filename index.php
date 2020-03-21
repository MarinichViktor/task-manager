<?php

use App\Controllers\AuthenticationController;
use App\Controllers\TaskController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

include("./vendor/autoload.php");
include("./framework/config/services.php");
include("./services.php");
$container->compile();

$request = Request::createFromGlobals();

$routes = new RouteCollection();
$routes->add('task.index', new Route(
    '/',
    ['_controller' => TaskController::class . '::index']
));
$routes->add('task.create', new Route(
    '/create',
    ['_controller' => TaskController::class . '::create']
));
$routes->add('task.store', new Route(
    '/store',
    ['_controller' => TaskController::class . '::store']
));
$routes->add('task.edit', new Route(
    '/edit/{id}',
    ['_controller' => TaskController::class . '::edit']
));
$routes->add('task.update', new Route(
    '/edit/{id}/save',
    ['_controller' => TaskController::class . '::update']
));
$routes->add('authentication.login', new Route(
    '/login',
    ['_controller' => AuthenticationController::class . '::login']
));
$routes->add('authentication.logout', new Route(
    '/logout',
    ['_controller' => AuthenticationController::class . '::logout']
));
$routes->add('authentication.authenticate', new Route(
    '/authenticate',
    ['_controller' => AuthenticationController::class . '::authenticate']
));

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$matcher->match($request->getPathInfo());
$request->attributes->add($matcher->match($request->getPathInfo()));

$kernel = $container->get('app')->handle($request)->send();

