<?php

namespace EsbiTest\Controller;

use EsbiTest\App\View;
use EsbiTest\Config\Database;
use EsbiTest\Exception\ValidationException;
use EsbiTest\Model\UserSigninRequest;
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
            "title" => "Esbi Test | Sign In"
        ]);
    }

    public function postSignin()
    {
        $request = new UserSigninRequest();
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];

        try {
            $response = $this->userService->login($request);
            View::redirect('/');
        } catch (ValidationException $exception) {
            View::render('User/signin', [
                'title' => 'Esbi Test | Sign In',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function signup()
    {
        View::render('User/signup', [
            "title" => "Esbi Test | Sign Up"
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
                'title' => 'ESBI Test | Sign Up',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function edit()
    {
        View::render('User/edit', [
            "title" => "Esbi Test | User Edit"
        ]);
    }

}