<?php

require __DIR__ . '/../services/historyeventservice.php';

class HistoryEventController
{

    private $historyeventService;

    function __construct()
    {
        $this->historyeventService = new HistoryEventService();
    }

    public function index()
    {
        if (isset($_POST["friday"])) {
            $model = $this->historyeventService->getHistoryEventsByDate('%2023-07-28%');
        } else if (isset($_POST["saturday"])) {
            $model = $this->historyeventService->getHistoryEventsByDate('%2023-07-29%');
        } else if (isset($_POST["sunday"])) {
            $model = $this->historyeventService->getHistoryEventsByDate('%2023-07-30%');
        } else if (isset($_POST["monday"])) {
            $model = $this->historyeventService->getHistoryEventsByDate('%2023-07-31%');
        } else {
            $model = $this->historyeventService->getAll();
        }

        require __DIR__ . '/../views/historyevent/index.php';
    }
}
