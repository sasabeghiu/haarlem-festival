<?php
require __DIR__ . '/../repositories/paymentrepository.php';

class PaymentService {
    private $paymentrepository;

    function __construct()
    {
        $this->paymentrepository = new PaymentRepository();
    }

    public function getPaymentDataJSON() {
        return $this->paymentrepository->getPaymentDataJSON();
    }
    public function getKey(string $key) {
        return $this->paymentrepository->getKey($key);
    }
}