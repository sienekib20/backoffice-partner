<?php

namespace app\controllers;

use app\models\App;
use core\database\Database;

class AppController
{
    public function index()
    {
        $templates = Database::select('select t.template_id, t.titulo, t.autor, (select file from files where file_id = t.file_id) as file, (select tipo_template from tipo_templates where tipo_template_id = t.tipo_template_id) as tipo_template, t.referencia from templates as t');

        return view('app.index', compact('templates'));
    }

    public function create_template()
    {
        return view('app.templates.add-template');
    }

    public function update($request)
    {
    }
}
