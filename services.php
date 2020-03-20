<?php

use App\Controllers\TaskController;

// Define application dependencies
$container->register(TaskController::class, TaskController::class)->setAutowired(true)->setPublic(true);
