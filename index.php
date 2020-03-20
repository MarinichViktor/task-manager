<?php

use App\Controllers\TaskController;
use Symfony\Component\HttpFoundation\Request;

include("./vendor/autoload.php");
include("./framework/config/services.php");
include("./services.php");
$container->compile();

$request = Request::createFromGlobals();
$request->attributes->add([
    '_controller' => 'App\Controllers\TaskController::index'
]);

$controller = $container->get(TaskController::class);
$kernel = $container->get('app')->handle($request)->send();

