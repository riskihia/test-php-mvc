<?php

namespace EsbiTest\Controller;

use EsbiTest\App\View;
use EsbiTest\Config\Database;
use EsbiTest\Exception\ValidationException;
use EsbiTest\Model\UserEditRequest;
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
            
            session_start();
            $_SESSION['user_id'] = $response->user->id;
            
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

            View::redirect('/users/signin');
        } catch (ValidationException $exception) {
            View::render('User/signup', [
                'title' => 'ESBI Test | Sign Up',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function edit(String $id)
    {
        session_start();
        if (isset($_SESSION['user_id'])) {
            $user = $this->userService->getUserById($id);
                
            View::render('User/edit', [
                "title" => "Esbi Test | User Edit",
                "user" => $user
            ]);   
        } else {
            View::render('User/signin', [
                "title" => "Esbi Test | Sign In"
            ]);    
        }
    }

    public function postEdit(String $id)
    {
        $request = new UserEditRequest();
        $request->id = $id;
        $request->oldUsername = $_POST['oldUsername'];
        $request->oldEmail = $_POST['oldEmail'];
        $request->newPassword = $_POST['newPassword'];
        $request->oldPassword = $_POST['oldPassword'];

        $user = $this->userService->getUserById($id);

        try {
            $this->userService->updateUser($request);
            View::redirect('/');
        } catch (ValidationException $exception) {
            View::render('User/Edit', [
                "title" => "Update user password",
                "error" => $exception->getMessage(),
                "user" => $user
            ]);
        }
    }

    public function postDelete(string $id)
    {
        session_start();
        if (isset($_SESSION['user_id'])) {
            $this->userService->deleteUser($id);
            
            View::redirect('/');
        } else {
            View::redirect('/');   
        }

    }

}