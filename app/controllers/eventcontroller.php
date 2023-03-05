<?php

require __DIR__ . '/controller.php';
require __DIR__ . '/../services/eventService.php';

class EventController extends Controller {

    private $eventService;

    function __construct(){
        $this->eventService = new EventService();
    }

    public function index(){

        $events = $this->eventService->getAll();

        $this->displayView($events);
    }
}