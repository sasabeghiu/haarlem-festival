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
        $repository = new LoginRepository();
        return $repository->login($username, $password);
    }

    public function register($username, $password, $email)
    {
        $repository = new LoginRepository();
        return $repository->register($username, $password, $email);
    }

    public function getByUsername($username)
    {
        $repository = new LoginRepository();
        return $repository->getByUsername($username);
    }

    public function getById($id)
    {
        $repository = new LoginRepository();
        return $repository->getById($id);
    }
}
