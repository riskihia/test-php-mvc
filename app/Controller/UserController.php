<?php

namespace EsbiTest\Controller;

use EsbiTest\App\View;
use EsbiTest\Config\Database;
use EsbiTest\Exception\ValidationException;
use EsbiTest\Model\UserSignupRequest;
use EsbiTest\Repository\UserRepository;
use EsbiTest\Service\UserService;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
    }

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

    public function postSignup()
    {
        $request = new UserSignupRequest();
        $request->username = $_POST['username'];
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];

        try {
            $this->userService->register($request);
            View::redirect('/');
        } catch (ValidationException $exception) {
            View::render('User/signup', [
                'title' => 'ESBI Test - Sign Up',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function edit()
    {
        View::render('User/edit', [
            "title" => "Esbi | User Edit"
        ]);
    }

}