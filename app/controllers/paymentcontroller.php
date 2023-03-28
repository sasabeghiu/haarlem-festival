<?php
require_once __DIR__ . "/../vendor/autoload.php";

class PaymentController
{
    //private $orderService;
    private $mollie;

    function __construct()
    {
        $this->mollie = new \Mollie\Api\MollieApiClient();
        $this->mollie->setApiKey("
        test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8");
    }

    public function index()
    {
        $method = $this->mollie->methods->get(\Mollie\Api\Types\PaymentMethod::IDEAL, ["include" => "issuers"]);
        require __DIR__ . '/../views/payment/index.php';
    }

    public function pay()
    {
        try {
            $amount = $_POST['amount'];
            $formatted_amount = number_format((float)$amount, 2, '.', '');
            $orderId = time();

            /*
             * Payment parameters:
             *   amount        Amount in EUROs. This example creates a € 10,- payment.
             *   description   Description of the payment.
             *   redirectUrl   Redirect location. The customer will be redirected there after the payment.
             *   webhookUrl    Webhook location, used to report when the payment changes state.
             *   metadata      Custom metadata that is stored with the payment.
             */
            $payment = $this->mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => (string)$formatted_amount,
                ],
                "description" => "Order #{orderId}",
                "redirectUrl" => "http://localhost\payment\status?orderId=1",
                "webhookUrl" => "http://localhost\payment\webhook",
                "metadata" => [
                    "order_id" => 1,
                ],
                "issuer" => !empty($_POST["issuer"]) ? $_POST["issuer"] : null,
            ]);

            //$this->orderService->saveStatus($orderId, $payment->status);

            header("Location: " . $payment->getCheckoutUrl(), true, 303);
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }
    public function status()
    {
        //$status = $this->orderService->getStatus($_GET["order_id"]));


        //echo "<p>Your payment status is '" . htmlspecialchars($status) . "'.</p>";
    }

    public function webhook()
    {
        try {

            /*
             * Retrieve the payment's current state.
             */
            $payment = $this->mollie->payments->get($_POST["id"]);
            $orderId = $payment->metadata->order_id;

            //$this->orderService->saveStatus($orderId, $payment->status);

            if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
                echo "Payment received.";
            } elseif ($payment->isOpen()) {
                echo "Payment is open.";
            } elseif ($payment->isPending()) {
                echo "Payment is pending.";
            } elseif ($payment->isFailed()) {
                echo "Payment failed.";
            } elseif ($payment->isExpired()) {
                echo "Payment is expired.";
            } elseif ($payment->isCanceled()) {
                echo "Payment is canceled.";
            } elseif ($payment->hasRefunds()) {
                echo "Payment is to be refunded.";
            } elseif ($payment->hasChargebacks()) {
                echo "Payment is The payment has been (partially) charged back. \n
                The status of the payment is still paid.";
            }
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }
}
