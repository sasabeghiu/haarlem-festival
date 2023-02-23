<?php
require __DIR__ . '/../services/eventservice.php';
include_once __DIR__ . '/../views/getURL.php';

class EventController
{
    private $eventService;

    function __construct()
    {
        $this->eventService = new EventService();
    }

    public function index()
    {
        if (isset($_POST["friday"])) {
            $model = $this->eventService->getEventsByDate('%2023-07-27%');
        } else if (isset($_POST["saturday"])) {
            $model = $this->eventService->getEventsByDate('%2023-07-28%');
        } else if (isset($_POST["sunday"])) {
            $model = $this->eventService->getEventsByDate('%2023-07-29%');
        } else {
            $model = $this->eventService->getAll();
        }

        require __DIR__ . '/../views/dance/eventsoverview.php';
    }
}
