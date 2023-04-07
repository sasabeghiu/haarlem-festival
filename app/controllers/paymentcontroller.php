<?php
require_once __DIR__ . "/../vendor/autoload.php";

require __DIR__ . '/../services/ordersservice.php';

class PaymentController
{
    //private $orderService;
    private $orderService;
    private $mollie;

    function __construct()
    {
        $this->mollie = new \Mollie\Api\MollieApiClient();
        $this->mollie->setApiKey("
        test_5jaAakyFRh8n9cNuC8p8aQR8gF3jp3");
        $this->orderService = new OrdersService();
    }

    public function index()
    {
        try {
            $orderId = $_GET['orderId'];
            $order = $this->orderService->getOnePlacedOrder($orderId);
            $total = $order->getTotalPrice();
            $subtotal = ($total * 0.21) + $total;

            $formatted_amount = number_format((float)$subtotal, 2, '.', '');

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
                "description" => "Order #{$orderId}",
                "redirectUrl" => "http://localhost\payment\status?orderId=$orderId",
                "webhookUrl" => "http://localhost\payment\status?orderId=$orderId",
                "metadata" => [
                    "order_id" => $orderId,
                ],

            ]);

            $this->orderService->addPayment($orderId, $payment->id);
            header("Location: " . $payment->getCheckoutUrl(), true, 303);
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }

    public function status()
    {
        $orderId = $_GET['orderId'];
        //If userid matches from session userid proceed
        $order = $this->orderService->getById($orderId);
        $payment = $this->mollie->payments->get($order->getPaymentId());
        $status = $payment->status;
        //hide email
        $email = $order->getEmailAddress();
        $hiddenEmail = substr_replace($email, str_repeat('*', strpos($email, '@') - 2), 2, strpos($email, '@') - 2); //replaces after first 2 chars with *, until the @ sign.


        if (!$payment->isPaid()) {
            require __DIR__ . '/../views/payment/paylater.php';
        } else {

            //send invoice and tickets
            require __DIR__ . '/../views/payment/paymentsuccessful.php';
        }
    }

    public function paylater()
    {

        //get order id
        //check status of payment use createdAt payment property
        //open payment and edit values redirect checkouturl
        //if payment successful redirect to status
        //otherwise cancel payment
    }




    public function createInvoice(Orders $order)
    {
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Haarlem Festival');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Invoice', 'Haarlem Festival', array(0, 64, 255), array(0, 64, 128));

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

        //prep values
        $name = $order->getFirstName() . " " . $order->getLastName();
        $address = $order->getStreetAddress();
        $country = $order->getCountry();
        $zipcode = $order->getZipCode();
        $phone = $order->getPhoneNumber();
        $orderItems = $this->orderService->getOrderItemsByOrderId($order->getId());
        //foreach item retrieve info and put it in html



        // add a page
        $pdf->AddPage();

        // write the HTML content into the PDF
        $html = '<h1>Haarlem Festival</h1>';
        $html .= "<h1>Invoice</h1>
        <div class='invoice-info'>
            <p><strong>Name:</strong>$name</p>
            <p><strong>Address:</strong>$address</p>
            <p><strong>Country:</strong>$country</p>
            <p><strong>Zipcode:</strong>$zipcode</p>
            <p><strong>Phone Number:</strong>$phone</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>";
        foreach ($orderItems as $item) {
            //
            $html .= "<tr>
                    <td>{$item->getName()}</td>
                    <td>{$item->getPrice()}</td>
                </tr>";
        }
        $html .= "<tr>
                    <td><strong>Subtotal</strong></td>
                    <td>$150.00</td>
                </tr>
                <tr>
                    <td><strong>VAT (10%)</strong></td>
                    <td>$15.00</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td>$165.00</td>
                </tr>
            </tbody>
        </table>";
        $pdf->writeHTML($html, true, false, true, false, '');


        // output the PDF as a file (you can also send it to a browser or save to a server)
        $pdf->Output('invoice.pdf', 'D');
    }
}
