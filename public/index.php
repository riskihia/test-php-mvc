<?php

use EsbiTest\App\Router;
use EsbiTest\Config\Database;
use EsbiTest\Controller\HomeController;

require_once __DIR__ . '/../vendor/autoload.php';

// Database::getConnection();

// // Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);

Router::run();