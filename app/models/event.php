<?php

use DateTime;

class event{

    public string $eventName;
    public string $eventType;

    public int $id;
    public string $datetime;
    public string $price;
    public Location $location;
    public int $tickets_available;
    public historyEvent $historyEvent;
    public jazzEvent $jazzEvent;

    public function getFormattedDate(){
        $date = new DateTime($this->datetime);
        return $date->format('d-m-Y');
    }
}