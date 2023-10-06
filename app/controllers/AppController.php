<?php

namespace app\controllers;

use app\models\App;

class AppController
{
    public function index()
    {
        return view('app.index');
    }

    public function update($request)
    {
    }
}
