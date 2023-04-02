<?php
require_once __DIR__ . "/../vendor/autoload.php";

require_once __DIR__ . '../vendor/tecnickcom/tcpdf/tcpdf.php';


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

    public function createInvoice()
    {
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Invoice', 'Your Company', array(0, 64, 255), array(0, 64, 128));

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // add a page
        $pdf->AddPage();

        // write the HTML content into the PDF
        $html = '<h1>Invoice</h1>';
        $html .= '<p>Here is the invoice content...</p>';
        $pdf->writeHTML($html, true, false, true, false, '');

        // output the PDF as a file (you can also send it to a browser or save to a server)
        $pdf->Output('invoice.pdf', 'D');
    }
}
