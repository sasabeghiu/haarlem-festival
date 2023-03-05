<?php

require __DIR__ . '/../repositories/eventRepository.php';

class EventService {

    public function getAll(){
        //retrieve data
        $repository = new EventRepository();
        $events = $repository->getAll();
        return $events;
    }

    public function insert($event){
        //retrieve data
        $repository = new EventRepository();
        $repository->insert($event);
    }
}
