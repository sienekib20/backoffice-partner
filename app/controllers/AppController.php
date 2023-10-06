<?php

namespace app\controllers;

use app\models\App;

class AppController
{
    public function index()
    {
        return view('app.templates.create-template');
    }

    public function update($request)
    {
    }
}
