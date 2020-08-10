<?php

use App\Components\Router;
use App\Controllers\IndexController;
use App\Controllers\TasksController;

Router::get('/', IndexController::class, 'index');

Router::get('create-task', TasksController::class, 'create');
Router::post('create-task', TasksController::class, 'createPost');