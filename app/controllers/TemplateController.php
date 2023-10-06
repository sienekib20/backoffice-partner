<?php

namespace app\controllers;

use Exception;
use core\database\DatabaseHelpers as Database;
use core\support\DirectoryManagement as Directory;
use core\support\Presets;

class TemplateController
{
    public function index()
    {
        return view('app.templates.create-template');
    }

    public function load_templates()
    {
    }

    public function create()
    {
        try {

            if (request()->methodIs('POST')) {
                $structure = Directory::createFolderStructure(request()->temp_name);

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

                            $countError = Directory::mu_file($file, $index, $structure, $type);
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

        /*

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $targetDirectory = "uploads/"; // Pasta onde os arquivos serão armazenados
            $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Verifique se o arquivo já existe
            if (file_exists($targetFile)) {
                echo "Desculpe, o arquivo já existe.";
                $uploadOk = 0;
            }

            // Verifique o tamanho do arquivo
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Desculpe, o arquivo é muito grande.";
                $uploadOk = 0;
            }

            // Permita apenas certos tipos de arquivos (neste exemplo, permitimos apenas imagens)
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Desculpe, apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
                $uploadOk = 0;
            }

            // Se $uploadOk for igual a 0, houve um erro no upload
            if ($uploadOk == 0) {
                echo "Desculpe, seu arquivo não foi enviado.";
            } else {
                // Tente fazer o upload do arquivo
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                    echo "O arquivo " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " foi enviado com sucesso.";
                } else {
                    echo "Desculpe, ocorreu um erro ao enviar o arquivo.";
                }
            }
        }

        var_dump('create');
        exit;*/
    }
}
