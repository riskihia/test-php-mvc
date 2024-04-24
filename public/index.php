<?php

use EsbiTest\App\Router;
use EsbiTest\Config\Database;
use EsbiTest\Controller\HomeController;
use EsbiTest\Controller\UserController;

require_once __DIR__ . '/../vendor/autoload.php';

// Database::getConnection();

// HOMECONTROLLER
Router::add('GET', '/', HomeController::class, 'index');

// USERCONTROLLER
Router::add('GET', '/users/signup', UserController::class, 'signup');
Router::add('POST', '/users/signup', UserController::class, 'postSignup');

Router::add('GET', '/users/signin', UserController::class, 'signin');
Router::add('POST', '/users/signin', UserController::class, 'postSignin');

Router::add('GET', '/users/edit', UserController::class, 'edit');

Router::run();