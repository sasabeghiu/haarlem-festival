<?php
require __DIR__ . '/../services/loginservice.php';

class LoginController
{
    private $loginService;

    function __construct()
    {
        $this->loginService = new LoginService();
    }

    public function index()
    {
        require __DIR__ . '/../views/login/index.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = isset($_POST['username']) ? $_POST['username'] : "";

            $password = isset($_POST['password']) ? $_POST['password'] : "";
            $hashedPass = password_hash($_POST['password'], PASSWORD_DEFAULT);

            if ($this->loginService->login($username, $hashedPass)) { //sends username and hashed password to check with hash from db
                echo "graaapee";
            } else {
                echo "kackee";
            }
        } else {
            echo "annana no post";
        }
    }
}
