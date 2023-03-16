<?php
require __DIR__ . '/../repositories/loginrepository.php';

class LoginService
{
    private $loginRepository;

    public function __construct()
    {
        $this->loginRepository = new LoginRepository();
    }

    public function login($username, $password)
    {
        return $this->loginRepository->login($username, $password);
    }

    public function register($username, $password, $email)
    {
        return $this->loginRepository->register($username, $password, $email);
    }

    public function getByUsername($username)
    {
        return $this->loginRepository->getByUsername($username);
    }

    public function getByEmail($email)
    {
        return $this->loginRepository->getByEmail($email);
    }

    public function getById($id)
    {
        return $this->loginRepository->getById($id);
    }

    public function updatePassword($userId, $password)
    {
        return $this->loginRepository->updatePassword($userId, $password);
    }

    public function createVerificationCode($code)
    {
        return $this->loginRepository->createVerificationCode($code);
    }

    public function isValid($code)
    {
        return $this->loginRepository->getLast($code);
    }

    public function deleteCode($code)
    {
        return $this->loginRepository->deleteCode($code);
    }
}
