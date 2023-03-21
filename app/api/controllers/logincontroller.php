<?php
require __DIR__ . '/../../services/loginservice.php';

class LoginController {

    private $loginService;

    function __construct()
    {
        $this->loginService = new LoginService();
    }

    public function index() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: *");


        // Respond to a GET request to /api/article
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            //$this->__construct();
            $articles = $this->loginService->getAll();
            header('Content-Type: application/json');
            echo json_encode($articles);
        }
    }
}