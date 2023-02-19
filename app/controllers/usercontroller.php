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

        require __DIR__ . '/../views/cms/user/index.php';
    }
    public function create()
    {
        //$model = $this->userService->getAll();

        require __DIR__ . '/../views/cms/user/create.php';
    }
    public function edit()
    {
        $user = $this->userService->getById($_GET['userId']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            print_r($_POST);
            $user = new User();
            $user->setId($_POST['id']);
            $user->setUsername('username');
            $user->setPassword('password');
            $user->setEmail('role');
            $user->setRole('email');
        }

        require __DIR__ . '/../views/cms/user/edit.php';
    }

    public function delete()
    {
        $user = $this->userService->deleteById($_GET['userId']);

        require __DIR__ . '/../views/cms/user/delete.php';
    }
}
