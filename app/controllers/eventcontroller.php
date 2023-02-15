<?php
require __DIR__ . '/../services/eventservice.php';
include_once __DIR__ . '/../views/getURL.php';

class EventController
{
    private $eventService;

    function __construct()
    {
        $this->eventService = new EventService();
    }

    public function index()
    {
        $model = $this->eventService->getAll();

        require __DIR__ . '/../views/dance/eventsoverview.php';
    }

    public function eventdetails()
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->eventService->getOne($params['id']);

        require __DIR__ . '/../views/dance/eventdetails.php';
    }
}