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

    public function generateQr()
    {
        $qr = new QRGenerator();
        //pass ticket id to generate QR
        $qr->generateQR("0x6ba7b8109dad11d180b400c04fd430c8");
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
}
