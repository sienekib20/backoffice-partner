<?php

namespace core\database\seeders;

class tipoTemplates
{
    public function insert()
    {
        database('tipo_templates')->insert([
            [
                'tipo_template' => 'Landing Page'
            ],
            [
                'tipo_template' => 'Dashboard'
            ],
            [
                'tipo_template' => 'Outro'
            ],
        ], true);
    }
}
