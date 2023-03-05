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

                $user = $this->loginService->getByUsername($username);
                $verificationCode = mt_rand(100000, 999999);
                print_r($verificationCode);
                if (!$this->loginService->createVerificationCode($user->getId(), $verificationCode) || !$this->sendEmail($user->getEmail(), $verificationCode)) {
                    echo "something failed in the process.";
                } else {
                    echo "alles gut";
                }
            }
        } catch (Exception $e) {
            echo $e;
        }

        //phpinfo();

        require __DIR__ . '/../views/login/resetpassword.php';
    }

    public function sendEmail($user, $verificationCode)
    {
        // the message
        $msg = "First line of text\nSecond line of text" .  $verificationCode;

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg, 70);

        // send email
        mail($user, "My subject", $msg);


        /* if (mail($to, $subject, $message, $headers)) {
            echo "Email sent successfully";
        } else {
            echo "Email sending failed";
        } */
    }
}
