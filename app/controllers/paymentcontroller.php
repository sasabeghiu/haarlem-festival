<?php

use PHPMailer\Mailer;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

require __DIR__ . '/../utils/mailer.php';
require_once __DIR__ . "/../vendor/autoload.php";
require __DIR__ . '/../services/ordersservice.php';
require __DIR__ . '/../services/ticketservice.php';

class PaymentController
{
    private $orderService;
    private $ticketService;
    private $mollie;
    private $mailer;
    function __construct()
    {
        $this->mollie = new \Mollie\Api\MollieApiClient();
        $this->mollie->setApiKey("
        test_5jaAakyFRh8n9cNuC8p8aQR8gF3jp3");
        $this->orderService = new OrdersService();
        $this->ticketService = new TicketService();
        $this->mailer = new Mailer();
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
        //add check to avoid mail re-sending when page refresh.
        $orderId = $_GET['orderId'];
        //If userid matches from session userid proceed
        $order = $this->orderService->getById($orderId);
        $payment = $this->mollie->payments->get($order->getPaymentId());
        $status = $payment->status;
        //hide email
        $email = $order->getEmailAddress();
        $hiddenEmail = substr_replace($email, str_repeat('*', strpos($email, '@') - 2), 2, strpos($email, '@') - 2); //replaces after first 2 chars with *, until the @ sign.


        if (!$payment->isPaid()) {
            //if payment is older than 24hr cancel it straight away.
            require __DIR__ . '/../views/payment/paylater.php';
        } else {
            phpinfo();

            //prepare invoice
            $receiver = $email;
            $receiver_name = $order->getFirstName() . " " . $order->getLastName();
            $subject = "Invoice - Haarlem Festival Support";
            $body_string = 'Thank you for your order, you will find the invoice attached to this email.';
            $invoice = $this->createInvoice($order);

            //prepare tickets
            $subject2 = "Tickets - Haarlem Festival Support";
            $body_string2 = 'Thank you for your order, you will find the tickets attached to this email.';
            $tickets = $this->createTickets($order);

            if ($this->mailer->sendEmail($receiver, $receiver_name, $subject, $body_string, $invoice) && $this->mailer->sendEmail($receiver, $receiver_name, $subject2, $body_string2, $tickets)) {
                require __DIR__ . '/../views/payment/paymentsuccessful.php';
            }
        }
    }

    public function paylater()
    {
        try {
            $orderId = $_GET['orderId'];
            $order = $this->orderService->getById($orderId);
            $payment = $this->mollie->payments->get($order->getPaymentId());
            $payment->description = "Order #" . $orderId;
            $payment->redirectUrl = "http://localhost\payment\status?orderId=$orderId";
            $payment->webhookUrl = "http://localhost\payment\status?orderId=$orderId";
            $payment->metadata = ["order_id" => $orderId];

            $payment = $payment->update();
            header("Location: " . $payment->getCheckoutUrl(), true, 303);
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
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
        $id = $order->getId();
        $name = $order->getFirstName() . " " . $order->getLastName();
        $address = $order->getStreetAddress();
        $mail = $order->getEmailAddress();
        $phone = $order->getPhoneNumber();
        $total = $order->getTotalPrice();
        $payment = $this->mollie->payments->get($order->getPaymentId());
        $paymentDate = $payment->createdAt;
        $dateTime = new DateTime($paymentDate);
        $formattedPaymentDate = $dateTime->format('d/m/Y H:i');
        $currentDate = date('d/m/Y');

        $tax = $total * 0.21;
        $subtotal = $tax + $total;
        $orderItems = $this->orderService->getOrderItemsByOrderId($order->getId());

        // add a page
        $pdf->AddPage();

        // write the HTML content into the PDF
        $html = '<h1>Haarlem Festival</h1>';
        $html .= "<h1>Invoice #$id</h1>
        <h3>$currentDate</h3>
        
        <div class='invoice-info'>
            <p><strong>Name: </strong>$name</p>
            <p><strong>Phone Number: </strong>$phone</p>
            <p><strong>Address: </strong>$address</p>
            <p><strong>Email Address: </strong>$mail</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Quantity</th>
                    <th>Event</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>";
        foreach ($orderItems as $item) {
            $ticket = $this->orderService->getProductInfo($item->getProduct_id());
            $name = $ticket[0]['event_name'];
            $price = $ticket[0]['event_price'];
            $qty = $ticket[0]['qty'];

            //echo $ticket;
            $html .= "<tr>
                    <td>$qty</td>
                    <td>$name</td>
                    <td>$price €</td>
                </tr><br/>";
        }

        $html .= "<tr>
                    <td><strong>Subtotal</strong></td>
                    <td>$total €</td>
                </tr>
                <tr>
                    <td><strong>VAT (21%)</strong></td>
                    <td>$tax €</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td>$subtotal €</td>

                </tr>
                <tr>
                    <td><strong>Payment Date</strong></td>
                    <td>$formattedPaymentDate</td>
                    
                </tr>
            </tbody>
        </table>";
        $pdf->writeHTML($html, true, false, true, false, '');


        // output the PDF as a file (you can also send it to a browser or save to a server)
        $invoice = $pdf->Output('invoice.pdf', 'S');
        return $invoice;
    }

    public function createTickets(Orders $order)
    {
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Haarlem Festival');
        $pdf->SetTitle('Tickets');
        $pdf->SetSubject('Tickets');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Tickets', 'Haarlem Festival', array(0, 64, 255), array(0, 64, 128));

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
        $userName = $order->getFirstName() . " " . $order->getLastName();
        $orderItems = $this->orderService->getOrderItemsByOrderId($order->getId());

        // add a page
        $pdf->AddPage();

        // write the HTML content into the PDF
        $html = "<h1>Haarlem Festival Tickets</h1>";

        foreach ($orderItems as $item) {
            //get product info
            $ticket = $this->orderService->getProductInfo($item->getProduct_id());
            $name = $ticket[0]['event_name'];
            $dateTime = $ticket[0]['event_datetime'];

            $registry = $this->ticketService->createTicket();
            $uuid = $registry->getUuid();
            $result = $this->generateQR($uuid);

            //generate QR
            $qr = $result->getDataUri();

            $html .= "<h1>Ticket #</h1>
            <table>
                <tr>
                    <th>Client name:</th>
                    <td>$userName</td>
                </tr>
                <tr>
                    <th>Event name:</th>
                    <td>$name</td>
                </tr>
                <tr>
                    <th>Date &amp; time:</th>
                    <td>$dateTime</td>
                </tr>
                <tr>
                    <th>QR code:</th>
                    <td>
                        <div class='qr-code'>
                        <img src='$qr'>
                        </div>
                    </td>
                </tr>
            </table>";
        }
        $pdf->writeHTML($html, true, false, true, false, '');

        // output the PDF as a file (you can also send it to a browser or save to a server)
        $tickets = $pdf->Output('invoice.pdf', 'S');
        return $tickets;
    }

    function generateQR($uid)
    {
        $qr = QrCode::create($uid);
        $writer = new PngWriter();
        $result = $writer->write($qr);

        // (C1) SAVE TO FILE
        //$result->saveToFile(__DIR__ . "/qr.png");

        // (C2) DIRECT OUTPUT
        //header("Content-Type: " . $result->getMimeType());
        return $result;

        // (C3) GENERATE DATA URI

    }
}
