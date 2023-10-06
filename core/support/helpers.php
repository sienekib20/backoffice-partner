<?php

use core\classes\database\Database;
use core\classes\Request;
use core\classes\Response;
use core\database\default\Connection;
use core\templates\View;

if (!function_exists('root')) :

    function root()
    {
        return dirname(__DIR__, 2);
    }

endif;

if (!function_exists('storage')) :

    function storage($path)
    {
        return "storage/{$path}/";
    }

endif;

if (!function_exists('response')) :

    function response()
    {
        static $instance = null;

        if (is_null($instance)) {

            $instance = (new Response());
        }

        return $instance;
    }

endif;

if (!function_exists('view_path')) :

    function view_path()
    {
        return root() . '/views/';
    }

endif;

if (!function_exists('view')) :

    function view($view, $params = [])
    {
        return View::render($view, $params);
    }

endif;

if (!function_exists('database')) :

    function database($table)
    {
        return (new Database($table));
    }

endif;

if (!function_exists('parts')) :

    function parts($part)
    {
        $parts = view_path() . "parts/" . str_replace('.', '/', $part) . ".html";

        try {
            if (!file_exists($parts)) {

                throw new Exception("Arquivo {$part} não encontrado", 1);
            }

            include $parts;
        } catch (Exception $ex) {
            repport('View Error', $ex, 404);
        }
    }

endif;

if (!function_exists('asset_path')) :

    function asset_path()
    {
        return 'http://localhost/backoffice-partner/public/assets/';
    }

endif;


if (!function_exists('asset')) :

    function asset($asset)
    {
        $fileType = explode('/', $asset)[0];

        return asset_path() . $asset;
    }

endif;

if (!function_exists('request')) :

    function request($key = '')
    {
        return (new Request($key));
    }

endif;

if (!function_exists('repport')) :

    function repport($key, \Exception $exception, $code = 200)
    {

        response()->setHttpResponseCode($code);

        die($key . ': ' .
            '<b>' . $exception->getMessage() . ' </b><br/> no arquivo ´' .
            '<b>' . $exception->getFile() . '</b>' . ':´ - <br/> na line: ´' .
            '<b>' . $exception->getLine() . '</b>');
    }

endif;


if (!function_exists('connection')) :

    function connection()
    {
        static $instance = null;

        if (is_null($instance)) {
            $instance = Connection::getConnectionInstance();
        }

        return $instance;
    }

endif;
