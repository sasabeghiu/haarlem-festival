 <style>
     .green {
         background-color: green;
     }

     .red {
         background-color: red;
     }
 </style>

 <?php
//fix the view
    if ($ticket == null) {
        echo "Invalid QR";
    } else {
        if ($this->ticketService->checkIfTicketWasScanned($uuid)) {
            echo "<body class='green'>Ticket was scanned successfully. </body>";
            $this->ticketService->updateTicketStatus("$uuid");
        } else {
            echo "<body class='red'>Ticket was scanned before!!! </body>";
        }
    }
    ?>