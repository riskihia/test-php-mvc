<?php

namespace EsbiTest\Controller;

use EsbiTest\App\View;

class HomeController
{
    function index()
    {
        View::render('Home/index', [
            "message" => "HomePage Esbi Test"
        ]);
    }

}