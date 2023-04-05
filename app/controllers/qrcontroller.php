<?php
require __DIR__ . '/../utils/qr-generator.php';
require __DIR__ . '/../utils/qr-scanner.php';

class QrController
{
      public function generateQr()
      {
          $qr = new QRGenerator();
          $qr->generateQR("the ticket uuid will be passed here");
      }
  
      public function scanQr()
      {
          $qrscan = new MobileQRScanner();
          $qrscan->scan();
      }
}