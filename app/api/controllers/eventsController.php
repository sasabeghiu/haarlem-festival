<?php

require __DIR__ . '/../../services/historyeventService.php';

class EventController
{

    private $eventService;

    function __construct(){
        $this->eventService = new EventService();
    }

    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: *");

        if ($_SERVER["REQUEST_METHOD"] == "GET"){
            $events = $this->eventService->getAll();
            header('Content-Type: application/json');
            echo json_encode($events);
        }
    }
}