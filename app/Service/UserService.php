<?php

namespace EsbiTest\Service;

use EsbiTest\Config\Database;
use EsbiTest\Domain\User;
use EsbiTest\Exception\ValidationException;
use EsbiTest\Model\UserSignupRequest;
use EsbiTest\Model\UserSignupResponse;
use EsbiTest\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserSignupRequest $request)
    {
        $this->validateUserRegistrationRequest($request);

        try {
            Database::beginTransaction();
            $user = $this->userRepository->findByUsername($request->username);
            if ($user != null) {
                throw new ValidationException("User username already exists");
            }
            
            $email = $this->userRepository->findByEmail($request->email);
            if ($email != null) {
                throw new ValidationException("User Email already exists");
            }

            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);

            $this->userRepository->save($user);

            $response = new UserSignupResponse();
            $response->user = $user;

            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateUserRegistrationRequest(UserSignupRequest $request)
    {
        if ($request->username == null || $request->password == null || trim($request->username) == "" || trim($request->password) == "") {
            throw new ValidationException(" Username, Password can not blank");
        }
    }
}