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

        require __DIR__ . '/../views/cms/user/edit.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            print_r($_POST);
            $newUser = new User();
            $newUser->setId($_GET['userId']);
            $newUser->setUsername('username');
            $newUser->setPassword('password');
            $newUser->setEmail('role');
            $newUser->setRole('email');
        }
    }

    public function delete()
    {
        $this->userService->deleteById($_GET['userId']);

        require __DIR__ . '/../views/cms/user/delete.php';
    }
}
