<?php
require __DIR__ . '/../../services/keysservice.php';

use \Firebase\JWT\JWT;

class KeysController {

    private $keysService;

    function __construct()
    {
        $this->keysService = new KeysService();
    }

    public function index() {
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: *");
        // header("Access-Control-Allow-Methods: *");


        // // Respond to a GET request to /api/article
        // if ($_SERVER["REQUEST_METHOD"] == "GET") {
        //     //$this->__construct();
        //     $articles = $this->loginService->getAll();
        //     header('Content-Type: application/json');
        //     echo json_encode($articles);
        // }
        
        if(!$_SESSION || !$_SESSION['loggedin'])
            http_response_code(401);

        require __DIR__ . '/../../views/api/manageapikeys.php';
    }

    public function createKey() {

        $secret_key = "H44Rl3M";

        $issuer = "Haarlem_Festival"; // this can be the domain/servername that issues the token
        $audience = "Finance.inc"; // this can be the domain/servername that checks the token

        $issuedAt = time(); // issued at
        $notbefore = $issuedAt; //not valid before 
        $expire = $issuedAt + 600; // expiration time is set at +600 seconds (10 minutes)

        // JWT expiration times should be kept short (10-30 minutes)
        // A refresh token system should be implemented if we want clients to stay logged in for longer periods

        // note how these claims are 3 characters long to keep the JWT as small as possible
        $payload = array(
            "iss" => $issuer,
            "aud" => $audience,
            "iat" => $issuedAt,
            "nbf" => $notbefore,
            "exp" => $expire,
            "data" => array(
                "id" => 1,
        ));

        $jwt = JWT::encode($payload, $secret_key, 'HS256');

        $this->keysService->addKey($jwt);
    }
}