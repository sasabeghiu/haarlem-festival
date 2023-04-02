<?php
require __DIR__ . '/../../services/paymentservice.php';

class PaymentController
{
    private $paymentservice;

    function __construct()
    {
        $this->paymentservice = new PaymentService();
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->__construct();

            if (!$this->verifyKey()) {
                http_response_code(401);
                return;
            }

            $articles = $this->paymentservice->getPaymentDataJSON();
            header('Content-Type: application/json');
            echo json_encode($articles);
        }
    }

    function verifyKey()
    {
        try {
            $enteredKey = htmlspecialchars($_GET['key']);
            $key = $this->paymentservice->getKey($enteredKey);

            if (is_null($key))
                return false;

            return $enteredKey == $key->getApi_key();
        } catch (Exception $e) {
            return false;
        }
    }
}
