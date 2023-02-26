<?php
require __DIR__ . '/../repositories/historyeventrepository.php';

class HistoryEventService
{
    public function getAll()
    {
        //retrieve data
        $repository = new HistoryEventRepository();
        $events = $repository->getAll();
        return $events;
    }

    public function insert($event)
    {
        //retrieve data
        $repository = new HistoryEventRepository();
        $repository->insert($event);
    }
}
