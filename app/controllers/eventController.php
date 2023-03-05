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

    public function eventcms()
    {
        //delete
        if (isset($_POST["delete"])) {
            $id = htmlspecialchars($_GET["deleteID"]);
            $this->eventService->deleteEvent($id);

            if ($this->eventService) {
                echo "<script>alert('Event deleted successfully. ')</script>";
            } else {
                echo "<script>alert('Failed to delete Event. ')</script>";
            }
        }
        //add
        if (isset($_POST["add"])) {
            $type = htmlspecialchars($_POST["type"]);
            $artist = htmlspecialchars($_POST["artistName"]);
            $venue = htmlspecialchars($_POST["venueName"]);
            $ticket_price = htmlspecialchars($_POST["price"]);
            $tickets_available = htmlspecialchars($_POST["stock"]);
            $datetime = htmlspecialchars($_POST["datetime"]);
            $image = htmlspecialchars($_POST["image"]);

            $event = new Music_Event();

            $event->setType($type);
            $event->setArtist($artist);
            $event->setVenue($venue);
            $event->setTicket_price($ticket_price);
            $event->setTickets_available($tickets_available);
            $event->setDatetime($datetime);
            $event->setImage($image);
            $event->setName($artist);

            $this->eventService->addEvent($event);

            if ($this->eventService) {
                echo "<script>alert('Event addedd successfully. ')</script>";
            } else {
                echo "<script>alert('Failed to add Event. ')</script>";
            }
        }
        //edit
        if (isset($_POST["edit"])) {
            $id = htmlspecialchars($_GET["updateID"]);
            $updateEvent = $this->eventService->getOne($id);
        }
        if (isset($_POST["update"])) {
            $type = htmlspecialchars($_POST["updatedType"]);
            $artist = htmlspecialchars($_POST["updatedArtistName"]);
            $venue = htmlspecialchars($_POST["updatedVenueName"]);
            $ticket_price = htmlspecialchars($_POST["updatedPrice"]);
            $tickets_available = htmlspecialchars($_POST["updatedStock"]);
            $datetime = htmlspecialchars($_POST["updatedDatetime"]);
            $image = htmlspecialchars($_POST["updatedImage"]);

            $event = new Music_Event();

            $event->setType($type);
            $event->setArtist($artist);
            $event->setVenue($venue);
            $event->setTicket_price($ticket_price);
            $event->setTickets_available($tickets_available);
            $event->setDatetime($datetime);
            $event->setImage($image);
            $event->setName($artist);

            $this->eventService->updateEvent($event, $_GET["updateID"]);

            if ($this->eventService) {
                echo "<script>alert('Event updated successfully. ')</script>";
            } else {
                echo "<script>alert('Failed to update Event. ')</script>";
            }
        }

        //sort events by type
        if (isset($_POST["dance"])) {
            $model = $this->eventService->getAllDanceEvents();
        } else if (isset($_POST["jazz"])) {
            $model = $this->eventService->getAllJazzEvents();
        } else {
            $model = $this->eventService->getAll();
        }

        require __DIR__ . '/../views/cms/music/musicevent-cms.php';
    }
}
