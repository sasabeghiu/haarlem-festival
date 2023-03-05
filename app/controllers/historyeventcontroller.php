<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/historyeventservice.php';

class HistoryEventController extends Controller
{
    private $eventService;

    function __construct()
    {
        $this->eventService = new HistoryEventService();
    }

    public function index()
    {
        $events = $this->eventService->getAll();

        $this->displayView($events);
    }
}
