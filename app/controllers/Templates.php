<?php

namespace app\controllers;

use core\database\DatabaseHelpers as Database;
use Exception;
use core\support\DirectoryManagement as Management;
use core\support\Presets;

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

                var_dump(request());exit;
                $structure = Management::createFolderStructure(request()->temp_name);

                $request = Presets::breakArray(request()->all(), 0, 8);

                $request['temp_reference']           = $structure['temp_name'];
                $request['temp_editable']       = (bool) $request['temp_editable'];
                $request['temp_payment_status'] = (int) $request['temp_payment_status'];
                $request['temp_price']          = Presets::formatNumber($request['temp_price'], 2);

                unset($request['temp_date']);

                $files = request()->file();
                $countError = 1;


                foreach ($files as $key => $file) {

                    if ($key == 'template_assets' || $key == 'template_images') {

                        foreach ($file['type'] as $index => $type) {

                            $countError = Management::mu_file($file, $index, $structure, $type);
                        }
                    } else if ($key == 'template_pages') {

                        foreach ($file['name'] as $index => $name) {
                            if (explode('.', $name)[0] != 'index') {

                                move_uploaded_file($file['tmp_name'][$index], $structure['pages'] . $file['name'][$index]);
                                $countError = 0;
                            } else {

                                move_uploaded_file($file['tmp_name'][$index], $structure['temp_dir'] . $file['name'][$index]);
                                $countError = 0;
                            }
                        }
                    }
                }

                if ($countError == 0) {
                    Database::insertIn('templates', $request);

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
