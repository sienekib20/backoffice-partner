<?php

namespace core\auth;

use core\support\Session;

class Authentication
{

    public function handle()
    {
        if (!Session::get('loggedin')) {
            header('Location: /login');
        }
    }
}
