<?php

use core\support\Session;

require __DIR__ . '/support/helpers.php';
require root() . '/vendor/autoload.php';

require root() . '/routes/web.php';

seeders()->run();

Session::start();


$routes->dispatch();

