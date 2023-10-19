<?php

use app\controllers\AppController;
use app\controllers\auth\authentication;
use app\controllers\TemplateController;
use app\controllers\Templates;
use core\classes\Route;

$routes = new Route();

$routes->addRoute('/', [authentication::class, 'login']);
$routes->addRoute('/login', [authentication::class, 'login']);

$routes->addRoute('/home', [AppController::class, 'index']);
$routes->addRoute('/templates/add', [Templates::class, 'index']);
$routes->addRoute('/templates/upload', [Templates::class, 'upload_template']);

$routes->addRoute('/user/[0-9]+', [AppController::class, 'update']);


$routes->addRoute('/template/create', [TemplateController::class, 'index']);
$routes->addRoute('/template/add', [TemplateController::class, 'create']);

