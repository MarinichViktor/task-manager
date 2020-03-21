<?php

use App\Controllers\TaskController;
use Symfony\Component\HttpFoundation\Request;

include("./vendor/autoload.php");
include("./framework/config/services.php");
include("./services.php");
$container->compile();

$request = Request::createFromGlobals();
if ($request->getPathInfo() == '/') {
    $request->attributes->add([
        '_controller' => 'App\Controllers\TaskController::index'
    ]);
} else if ($request->getPathInfo() == '/create') {
    $request->attributes->add([
        '_controller' => 'App\Controllers\TaskController::create'
    ]);
} else {
    $request->attributes->add([
        '_controller' => 'App\Controllers\TaskController::store'
    ]);
}

$controller = $container->get(TaskController::class);
$kernel = $container->get('app')->handle($request)->send();

