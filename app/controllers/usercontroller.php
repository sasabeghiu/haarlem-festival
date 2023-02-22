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
            $newUser = new User();
            $hashedPass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $newUser->setId(isset($_POST['id']) ? $_POST['id'] : 0);
            $newUser->setUsername(isset($_POST['username']) ? $_POST['username'] : null); //check if information was sent, if so it assigns the value, otherwise sets to null 
            $newUser->setPassword(isset($_POST['password']) ? $hashedPass : null);
            $newUser->setEmail(isset($_POST['email']) ? $_POST['email'] : null);
            $newUser->setRole(isset($_POST['role']) ? $_POST['role'] : null);

            if ($this->userService->saveUser($newUser)) {
                $this->index();
            }
        }
    }

    public function delete()
    {
        $this->userService->deleteById($_GET['userId']);

        require __DIR__ . '/../views/cms/user/delete.php';
    }
}
