<?php

namespace app\controllers;

use core\database\DatabaseHelpers as Database;
use Exception;
use core\support\DirectoryManagement as Management;
use core\support\Presets;
use core\support\Struct;

class Templates
{
    public function index()
    {
        return view('app.templates.add-template');
    }

    public function upload_template()
    {
        try {

            if (request()->methodIs('POST')) {

                $request = (object) request()->all();

                $files = request()->file();

                $reference = Struct::create_structure($request->temp_title, $files);

                if ($reference) {

                    $preco = Presets::formatNumber($request->temp_price ?? '0', 2);

                    database('templates')->insert([
                        'titulo' => $request->temp_title, 'tipo_template_id' => database()->select('select tipo_template_id from tipo_templates where tipo_template = ?', [$request->temp_type])[0], 'referencia' => $reference, 'descricao' => $request->temp_description, 'autor' => 'Sílica', 'editar' => $request->temp_editable, 'estado_pagamento' => $request->temp_payment_status, 'preco' => $preco
                    ]);

                    response()->setHttpResponseCode(200);
                    return header('Location: /template/create');
                }
                throw new Exception("Erro ao cria um novo template", 1);
            }
        } catch (Exception $ex) {

            repport('Erro de armazenamento', $ex, 500);
        }
    }
}
