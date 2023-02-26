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

    public function validate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = isset($_POST['username']) ? $_POST['username'] : "";
            $password = isset($_POST['password']) ? $_POST['password'] : "";
            $user = $this->loginService->getByUsername($username);
            $passtocompare = $user->getPassword();

            if (password_verify($password, $passtocompare)) {
                $_SESSION['userId'] = $user->getId();
                //print_r($_SESSION['userId']);
                $_SESSION['loggedin'] = true;

                header('Location: /home/index');
            } else {
                echo "Login error: Username or password incorrect.";
            }
        }
        $this->index();
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

    public function resetpassword()
    {
        session_start();
        print_r($_SESSION['userId']);
        $user = $this->loginService->getById($id);
        require __DIR__ . '/../views/login/resetpassword.php';
    }
}
