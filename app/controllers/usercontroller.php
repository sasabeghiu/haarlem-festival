<?php
require __DIR__ . '/../services/userservice.php';

class UserController
{
    private $userService;

    function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        $model = $this->userService->getAll();
        $roles = $this->userService->getRoles();

        require __DIR__ . '/../views/cms/user/index.php';
    }
    public function create()
    {
        $roles = $this->userService->getRoles();

        require __DIR__ . '/../views/cms/user/create.php';
    }
    public function edit()
    {
        $user = $this->userService->getById($_GET['userId']);
        $roles = $this->userService->getRoles();

        require __DIR__ . '/../views/cms/user/edit.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {

                $newUser = new User();
                $hashedPass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $newUser->setId(htmlspecialchars(isset($_POST['id']) ? $_POST['id'] : 0));
                $newUser->setUsername(htmlspecialchars(isset($_POST['username']) ? $_POST['username'] : null)); //sanitize input, check if information was sent, if so it assigns the value, otherwise sets to null 
                $newUser->setPassword(htmlspecialchars(isset($_POST['password']) ? $hashedPass : null));
                $newUser->setEmail(htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : null));
                $newUser->setRole(htmlspecialchars(isset($_POST['role']) ? $_POST['role'] : null));


                if ($this->userService->validateUser($newUser)) {
                    if ($this->userService->saveUser($newUser)) {
                        header('Location: /user');
                    }
                    echo "<script>alert('Failed to save User. ')</script>";
                } else {
                    echo "<script>alert('Username or email already in use!')</script>";
                }
                $this->index();
            } catch (Exception $e) {
                echo "An error occurred: " . $e->getMessage();
            }
        }
    }

    public function delete()
    {
        require __DIR__ . '/../views/cms/user/delete.php';
        $userId = $_GET['userId'];
        if ($this->userService->deleteById($userId)) {
            echo "<script>alert('User deleted successfully. ')</script>";
        } else {
            echo "<script>alert('Failed to delete User. ')</script>";
        }
    }

    public function profile()
    {
        session_start();
        //print_r($_SESSION['userId']);
        $user = $this->userService->getById($_SESSION['userId']);
        require __DIR__ . '/../views/cms/user/profile.php';
    }
}
