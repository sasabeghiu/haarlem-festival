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
        $user = $this->userService->saveUser($_POST[]);

        require __DIR__ . '/../views/cms/user/create.php';
    }
    public function edit()
    {
        $user = $this->userService->getById($_GET['userId']);
        $roles = $this->userService->getRoles();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            print_r($_POST);
            $user = new User();
            $user->setId($_POST['id']);
            $user->setUsername($_POST['username']);
            $user->setPassword($_POST['password']);
            $user->setEmail($_POST['email']);
            $user->setRole($_POST['role ']);
        }

        require __DIR__ . '/../views/cms/user/edit.php';
    }

    public function delete()
    {
        $this->userService->deleteById($_GET['userId']);
        $user = $this->userService->deleteById($_GET['userId']);
        header('Location: /user/index');

        require __DIR__ . '/../views/cms/user/delete.php';
    }
}
