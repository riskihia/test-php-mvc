<?php

namespace EsbiTest\Service;

use EsbiTest\Config\Database;
use EsbiTest\Domain\User;
use EsbiTest\Exception\ValidationException;
use EsbiTest\Model\UserEditRequest;
use EsbiTest\Model\UserEditResponse;
use EsbiTest\Model\UserSigninRequest;
use EsbiTest\Model\UserSigninResponse;
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

    public function getUserById(string $id): User
    {
        $user = $this->userRepository->findById($id);
        if ($user == null) {
            throw new ValidationException("User not found");
        }
        return $user;
    }
    
    public function getUserByUsername(string $username): User
    {
        $user = $this->userRepository->findByUsername($username);
        if ($user == null) {
            throw new ValidationException("User not found");
        }
        return $user;
    }

    public function register(UserSignupRequest $request): UserSignupResponse
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

    public function login(UserSigninRequest $request): UserSigninResponse
    {
        $this->validateUserLoginRequest($request);

        $user = $this->userRepository->findByEmail($request->email);
        if ($user == null) {
            throw new ValidationException("Email or password is wrong");
        }

        if (password_verify($request->password, $user->password)) {
            $response = new UserSigninResponse();
            $response->user = $user;
            
            return $response;
        } else {
            throw new ValidationException("Email or password is wrong");
        }
    }

    private function validateUserLoginRequest(UserSigninRequest $request)
    {
        if ($request->email == null || $request->password == null ||
            trim($request->email) == "" || trim($request->password) == "") {
            throw new ValidationException("Email, Password can not blank");
        }
    }

    private function validateUserRegistrationRequest(UserSignupRequest $request)
    {
        if ($request->username == null || $request->password == null || trim($request->username) == "" || trim($request->password) == "") {
            throw new ValidationException(" Username, Password can not blank");
        }
    }

    public function deleteUser(string $id)
    {
        unset($_SESSION['user_id']);
        session_destroy();

        $this->userRepository->deleteById($id);
    }

    public function updateUser(UserEditRequest $request): UserEditResponse
    {
        $this->validateUserEditRequest($request);

        try {
            Database::beginTransaction();

            $user = $this->userRepository->findById($request->id);
            if ($user == null) {
                throw new ValidationException("User is not found");
            }

            if (!password_verify($request->oldPassword, $user->password)) {
                throw new ValidationException("Old password is wrong");
            }

            $user->password = password_hash($request->newPassword, PASSWORD_BCRYPT);
            $this->userRepository->update($user);

            Database::commitTransaction();

            $response = new UserEditResponse();
            $response->user = $user;
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateUserEditRequest(UserEditRequest $request)
    {
        if ($request->oldUsername == null || $request->oldEmail == null || $request->oldPassword == null ||
            trim($request->oldUsername) == "" || trim($request->oldEmail) == "" || trim($request->oldPassword) == "") {
            throw new ValidationException("Username, Email, Password, can not blank");
        }
    }
}