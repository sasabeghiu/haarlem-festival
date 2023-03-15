<?php

use PHPMailer\Mailer;

require __DIR__ . '/../services/loginservice.php';
require __DIR__ . '/../utils/mailer.php';

class LoginController
{
    private $loginService;
    private $mailer;

    function __construct()
    {
        $this->loginService = new LoginService();
        $this->mailer = new Mailer();
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
                        header('Location: /page/festival');
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

            $username = $_POST['username'];

            $password = $_POST['password'];
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);

            $email = $_POST['email'];

            // Validate updated information
            if (empty($email) || !$this->loginService->getByEmail($email) == null) {

                echo "<script>alert('email already exists!')</script>";
                echo $this->display();
            } else if (empty($username) || !$this->loginService->getByUsername($username) == null) {

                echo "<script>alert('username already exists!')</script>";
                $this->display();
            } else if (strlen($password) < 6) {
                echo "<script>alert('Password must be at least 6 characters long.')</script>";
                $this->display();
            } else {

                if ($this->loginService->register($username, $hashedPass, $email)) {

                    echo "<script>alert('Register successful! ')</script>";
                    $this->index();
                }
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

    public function createCode()
    {
        try {
            $username = isset($_POST['username']) ? $_POST['username'] : "";

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['username'] != null) {
                session_start();

                $user = $this->loginService->getByUsername($username);
                $_SESSION['username'] = $user->getUsername();
                $verificationCode = mt_rand(100000, 999999);

                print_r($verificationCode);
                $receiver = $user->getEmail();
                $receiver_name = $user->getUsername();
                $subject = "Verification Code - Haarlem Festival Support";
                $link = "http://localhost/login/verifyCode?code=" . $verificationCode;
                $body_string = 'Click on the link to reset your password: ' . $link;
                if (!$this->loginService->createVerificationCode($verificationCode) || !$this->mailer->sendEmail($receiver, $receiver_name,  $subject, $body_string)) {
                    echo "something failed in the process.";
                } else {
                    echo "alles gut";
                }
            }
        } catch (Exception $e) {
            echo $e;
        }
        require __DIR__ . '/../views/login/resetpassword.php';
    }

    public function verifyCode()
    {
        //change $this
        try {
            $code = $_GET['code'];

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $password1 = $_POST['password'];
                $password2 = $_POST['confirmPassword'];

                if ($this->loginService->isValid($code) && $password1 == $password2) {
                    echo 'success';
                } else {
                    echo "nono";
                }
            }
        } catch (Exception $e) {
            echo $e;
        }

        require __DIR__ . '/../views/login/newpassword.php';
    }
}
