<?php

namespace EsbiTest\Controller;

use EsbiTest\App\View;

class UserController
{
    public function signin()
    {
        View::render('User/signin', [
            "title" => "Esbi | Sign In"
        ]);
    }

    public function signup()
    {
        View::render('User/signup', [
            "title" => "Esbi | Sign Up"
        ]);
    }

    public function edit()
    {
        View::render('User/edit', [
            "title" => "Esbi | User Edit"
        ]);
    }

}