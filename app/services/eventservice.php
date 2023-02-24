<?php
require __DIR__ . '/../repositories/eventrepository.php';

class EventService
{
    private $eventRepository;

    public function __construct()
    {
        $this->eventRepository = new EventRepository();
    }

    public function getAll()
    {
        return $this->eventRepository->getAll();
    }

    public function getOne($id)
    {
        return $this->eventRepository->getOne($id);
    }

    public function getEventsByDate($datetime)
    {
        return $this->eventRepository->getEventsByDate($datetime);
    }

    public function getEventsByArtistID($artistID)
    {
        return $this->eventRepository->getEventsByArtistID($artistID);
    }

    public function getEventsByVenueID($venueID)
    {
        return $this->eventRepository->getEventsByVenueID($venueID);
    }
}
