<?php

namespace EsbiTest\Controller;

use EsbiTest\App\View;
use EsbiTest\Config\Database;
use EsbiTest\Repository\UserRepository;
use EsbiTest\Service\UserService;

class HomeController
{
    private UserService $userService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
    }


    function index()
    {
        session_start();
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $user = $this->userService->getUserById($user_id);
                        
            View::render('Home/index', [
                "title" => "Esbi Test | Sign Up",
                "user" => $user
            ]);    
        } else {
            View::render('User/signin', [
                "title" => "Esbi Test | Sign In"
            ]);    
        }
        
    }

}