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
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $username = isset($_POST['username']) ? $_POST['username'] : "";
                $password = isset($_POST['password']) ? $_POST['password'] : "";
                $user = $this->loginService->getByUsername($username);
                if ($user != null) {
                    if (password_verify($password, $user->getPassword())) {
                        session_start();
                        $_SESSION['userId'] = $user->getId();
                        $_SESSION['loggedin'] = true;
                        header('Location: /home/index');
                    }
                }
                echo "Login error: Username or password incorrect.";
                $this->index();
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = isset($_POST['username']) ? $_POST['username'] : "";

            $password = isset($_POST['password']) ? $_POST['password'] : "";
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);

            $email = isset($_POST['email']) ? $_POST['email'] : "";

            if ($this->loginService->getByUsername($username) == null || $this->loginService->getByEmail($email) == null) //returns true if username or email exist in db
            {
                echo "<script>alert('Username of email already exists!')</script>";
            } else {
                if ($this->loginService->register($username, $hashedPass, $email)) {
                    echo "<script>alert('Register successful! ')</script>";
                    echo $this->index();
                }
            }
        }
        echo $this->display();
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
        $user = $this->loginService->getById($_SESSION['userId']);
        require __DIR__ . '/../views/login/resetpassword.php';
    }
}
