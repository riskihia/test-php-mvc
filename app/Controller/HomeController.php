<?php

namespace EsbiTest\Controller;

use EsbiTest\App\View;

class HomeController
{
    function index()
    {
        View::render('Home/index', [
            "title" => "Esbi | Sign Up",
            "message" => "HomePage Esbi Test"
        ]);
    }

}