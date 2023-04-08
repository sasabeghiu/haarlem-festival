<?php
require __DIR__ . '/../repositories/ticketrepository.php';

class TicketService
{
    private $ticketRepository;

    public  function __construct()
    {
        $this->ticketRepository = new TicketRepository();
    }

    public function getTicketById($uuid)
    {
        return $this->ticketRepository->getTicketById($uuid);
    }

    public function checkIfTicketWasScanned($uuid)
    {
        return $this->ticketRepository->checkIfTicketWasScanned($uuid);
    }

    public function updateTicketStatus($uuid)
    {
        return $this->ticketRepository->updateTicketStatus($uuid);
    }
}
