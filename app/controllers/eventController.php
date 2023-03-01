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

    public function danceevents()
    {
        if (isset($_POST["friday"])) {
            $model = $this->eventService->getDanceEventsByDate('%2023-07-27%');
        } else if (isset($_POST["saturday"])) {
            $model = $this->eventService->getDanceEventsByDate('%2023-07-28%');
        } else if (isset($_POST["sunday"])) {
            $model = $this->eventService->getDanceEventsByDate('%2023-07-29%');
        } else {
            $model = $this->eventService->getAllDanceEvents();
        }

        require __DIR__ . '/../views/dance/eventsoverview.php';
    }

    public function jazzevents()
    {
        if (isset($_POST["thursday"])) {
            $model = $this->eventService->getJazzEventsByDate('%2023-07-26%');
        } else if (isset($_POST["friday"])) {
            $model = $this->eventService->getJazzEventsByDate('%2023-07-27%');
        } else if (isset($_POST["saturday"])) {
            $model = $this->eventService->getJazzEventsByDate('%2023-07-28%');
        } else if (isset($_POST["sunday"])) {
            $model = $this->eventService->getJazzEventsByDate('%2023-07-29%');
        } else {
            $model = $this->eventService->getAllJazzEvents();
        }

        require __DIR__ . '/../views/jazz/eventsoverview.php';
    }
}
