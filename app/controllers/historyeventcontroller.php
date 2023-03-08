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

        $model = $this->historyeventService->getAll();

        require __DIR__ . '/../views/historyevent/index.php';
    }
}
