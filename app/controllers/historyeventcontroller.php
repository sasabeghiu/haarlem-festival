<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/historyeventservice.php';

class HistoryEventController extends Controller
{
    private $historyeventService;

    function __construct()
    {
        $this->historyeventService = new HistoryEventService();
    }

    public function index()
    {
        $historyevents = $this->historyeventService->getAll();

        $this->displayView($historyevents);
    }
}
