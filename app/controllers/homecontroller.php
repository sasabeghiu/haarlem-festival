<?php
require __DIR__ . '/../services/homeservice.php';

class HomeController
{
    private $homeService;

    function __construct()
    {
        $this->homeService = new HomeService();
    }

    public function index()
    {
        require __DIR__ . '/../views/home/index.php';
    }

    public function about()
    {
        require __DIR__ . '/../views/home/about.php';
    }

    public function homepage()
    {
        $homepage = $this->homeService->getAll();
        require __DIR__ . '/../views/home/homepage.php';
    }
}
