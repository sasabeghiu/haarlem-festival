<?php

require __DIR__ . '/../repositories/historyeventrepository.php';

class HistoryEventService
{
    private $historyeventRepository;

    function __construct()
    {
        $this->historyeventRepository = new HistoryEventRepository();
    }

    public function getAll()
    {
        //retrieve data
        return $this->historyeventRepository->getAll();
    }
}
