<?php
require __DIR__ . '/../vendor/autoload.php';

use Zxing\QrReader;

class MobileQRScanner
{
  function __construct()
  {
  }

  function scan()
  {
    $qrcode = new QrReader(__DIR__ . '/qr.png');
    $text = $qrcode->text(); //return decoded text from QR Code
    echo $text;

    //read the qr code for every ticket
    //get the text
    //compare the text with a ticket uuid
    //if (text===ticket.uid && ticket.status != scanned)
    //ticket.status change from not scanned to scanned
    //light up as green
    //else
    //light up as red 
  }
}
