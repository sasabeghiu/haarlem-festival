<?php

require __DIR__ . '/../repositories/historyeventRepository.php';

class HistoryEventService {

    public function getAll(){
        //retrieve data
        $repository = new HistoryEventRepository();
        $historyevents = $repository->getAll();
        return $historyevents;
    }

    public function insert($historyevent){
        //retrieve data
        $repository = new HistoryEventRepository();
        $repository->insert($historyevent);
    }
}
