<?php
require __DIR__ . '/../services/eventservice.php';
require __DIR__ . '/../services/artistservice.php';
require __DIR__ . '/../services/venueservice.php';

include_once __DIR__ . '/../views/getURL.php';

class EventController
{
    private $eventService;
    private $artistService;
    private $venueService;

    function __construct()
    {
        $this->eventService = new EventService();
        $this->artistService = new ArtistService();
        $this->venueService = new VenueService();
    }

    public function danceevents()
    {
        if (isset($_POST["thursday"])) {
            $model = $this->eventService->getDanceEventsByDate('%2023-07-27%');
        } else if (isset($_POST["friday"])) {
            $model = $this->eventService->getDanceEventsByDate('%2023-07-28%');
        } else if (isset($_POST["saturday"])) {
            $model = $this->eventService->getDanceEventsByDate('%2023-07-29%');
        } else {
            $model = $this->eventService->getAllDanceEvents();
        }

        require __DIR__ . '/../views/dance/eventsoverview.php';
    }

    public function jazzevents()
    {
        if (isset($_POST["wednesday"])) {
            $model = $this->eventService->getJazzEventsByDate('%2023-07-26%');
        } else if (isset($_POST["thursday"])) {
            $model = $this->eventService->getJazzEventsByDate('%2023-07-27%');
        } else if (isset($_POST["friday"])) {
            $model = $this->eventService->getJazzEventsByDate('%2023-07-28%');
        } else if (isset($_POST["saturday"])) {
            $model = $this->eventService->getJazzEventsByDate('%2023-07-29%');
        } else {
            $model = $this->eventService->getAllJazzEvents();
        }

        require __DIR__ . '/../views/jazz/eventsoverview.php';
    }

    // cms part

    public function addEvent()
    {
        $type = htmlspecialchars($_POST["type"]);
        $artist = htmlspecialchars($_POST["artistName"]);
        $venue = htmlspecialchars($_POST["venueName"]);
        $ticket_price = htmlspecialchars($_POST["price"]);
        $tickets_available = htmlspecialchars($_POST["stock"]);
        $datetime = htmlspecialchars($_POST["datetime"]);

        $event = new Music_Event();

        $event->setType($type);
        $event->setArtist($artist);
        $event->setVenue($venue);
        $event->setTicket_price($ticket_price);
        $event->setTickets_available($tickets_available);
        $event->setDatetime($datetime);
        $event->setImage(1);
        $event->setName($artist);

        $this->eventService->addEvent($event);

        if ($this->eventService) {
            echo "<script>alert('Event addedd successfully. ')</script>";
        } else {
            echo "<script>alert('Failed to add Event. ')</script>";
        }
    }

    public function updateEvent()
    {
        $type = htmlspecialchars($_POST["updatedType"]);
        $artist = htmlspecialchars($_POST["updatedArtistName"]);
        $venue = htmlspecialchars($_POST["updatedVenueName"]);
        $ticket_price = htmlspecialchars($_POST["updatedPrice"]);
        $tickets_available = htmlspecialchars($_POST["updatedStock"]);
        $datetime = htmlspecialchars($_POST["updatedDatetime"]);

        $event = new Music_Event();

        $event->setType($type);
        $event->setArtist($artist);
        $event->setVenue($venue);
        $event->setTicket_price($ticket_price);
        $event->setTickets_available($tickets_available);
        $event->setDatetime($datetime);
        $event->setImage(1);
        $event->setName($artist);

        $this->eventService->updateEvent($event, $_GET["updateID"]);

        if ($this->eventService) {
            echo "<script>alert('Event updated successfully. ')</script>";
        } else {
            echo "<script>alert('Failed to update Event. ')</script>";
        }
    }

    public function deleteEvent()
    {
        $id = htmlspecialchars($_GET["deleteID"]);
        $this->eventService->deleteEvent($id);

        if ($this->eventService) {
            echo "<script>alert('Event deleted successfully. ')</script>";
        } else {
            echo "<script>alert('Failed to delete Event. ')</script>";
        }
    }

    public function eventcms()
    {
        if (isset($_POST["delete"])) {
            $this->deleteEvent();
        }
        if (isset($_POST["add"])) {
            $this->addEvent();
        }
        if (isset($_POST["edit"])) {
            $id = htmlspecialchars($_GET["updateID"]);
            $updateEvent = $this->eventService->getOne($id);
        }
        if (isset($_POST["update"])) {
            $this->updateEvent();
        }

        //sort events by type dance or jazz
        if (isset($_POST["dance"])) {
            $model = $this->eventService->getAllDanceEvents();
        } else if (isset($_POST["jazz"])) {
            $model = $this->eventService->getAllJazzEvents();
        } else {
            $model = $this->eventService->getAll();
        }

        $artists = $this->artistService->getAll();
        $venues = $this->venueService->getAll();

        require __DIR__ . '/../views/cms/music/musicevent-cms.php';
    }
}
