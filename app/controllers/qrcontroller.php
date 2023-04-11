<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../utils/qr-generator.php';

require __DIR__ . '/../services/ticketservice.php';

use Zxing\QrReader;

class QrController
{
    private $ticketService;

    function __construct()
    {
        $this->ticketService = new TicketService();
    }
    public function index()
    {
        require __DIR__ . '/../views/qr.php';
    }

    public function generateQr($uuid)
    {
        $qr = new QRGenerator();
        //pass ticket id to generate QR
        $qrcode = $qr->generateQR($uuid);
        return $qrcode;
    }

    public function scanQr()
    {
        //get qr img
        $qrcode = new QrReader(__DIR__ . '/../utils/qr.png');
        //return decoded uuid from QR Code
        $uuid = $qrcode->text();
        //display qr text
        echo "This text's from QR is UUID: " . $uuid . '<br>';
        //get ticket by qr text
        $ticket = $this->ticketService->getTicketById("$uuid");

        require __DIR__ . '/../views/qr-scanner.php';
    }

    public function scan()
    {
        if ($_SESSION['role'] == 3) {
            $uuid = $_GET['uuid'];
            $ticket = $this->ticketService->checkIfTicketWasScanned($uuid);
            if (!$ticket) {
                //ticket was scanned or not existent in db.
                echo "<script>alert('Ticket is invalid or was already scanned'); window.location = '/';</script>";
            }
            $this->ticketService->updateTicketStatus($uuid); //change status to scanned
            echo "<script>alert('Ticket scanned successfully'); window.location = '/';</script>";
        }
        echo "<script>alert('You must be an employee to access this page!'); window.location = '/';</script>";
    }
}
