<?php

use app\controllers\AppController;
use app\controllers\TemplateController;
use core\classes\Route;

$routes = new Route();

$routes->addRoute('/', [AppController::class, 'index']);
$routes->addRoute('/user/[0-9]+', [AppController::class, 'update']);

$routes->addRoute('/template/create', [TemplateController::class, 'index']);
$routes->addRoute('/template/add', [TemplateController::class, 'create']);

$routes->dispatch();
