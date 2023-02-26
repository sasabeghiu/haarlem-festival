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
            $passtocompare = $this->loginService->getPassByUsername($username);

            if (password_verify($password, $passtocompare)) {
                $_SESSION['username'] = $username;
                $_SESSION['loggedin'] = true;
                session_start();
                header('Location: /home/index');
            } else {
                $message = "Login error: Username or password incorrect.";
            }
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = isset($_POST['username']) ? $_POST['username'] : "";

            $password = isset($_POST['password']) ? $_POST['password'] : "";

            $hashedPass = password_hash($password, PASSWORD_DEFAULT);

            $email = isset($_POST['email']) ? $_POST['email'] : "";

            if ($this->loginService->register($username, $hashedPass, $email)) {
                echo "Register successful";
                echo $this->index();
            }
        }
    }

    public function display()
    {
        require __DIR__ . '/../views/login/register.php';
    }

    public function logout()
    {
        require __DIR__ . '/../views/login/logout.php';
    }
}
