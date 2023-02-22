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
}
