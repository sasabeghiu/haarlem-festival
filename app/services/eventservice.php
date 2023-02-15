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
}
