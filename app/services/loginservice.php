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

    public function createVerificationCode($id, $code)
    {

        return $this->loginRepository->createVerificationCode($id, $code);
    }
}
