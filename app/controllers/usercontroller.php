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

        require __DIR__ . '/../views/cms/user/edit.php';
    }
}
