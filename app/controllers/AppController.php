<?php

namespace app\controllers;

use app\models\App;

class AppController
{
    public function index()
    {
        return view('app.index');
    }

    public function create_template()
    {
        return view('app.templates.add-template');
    }

    public function update($request)
    {
    }
}
