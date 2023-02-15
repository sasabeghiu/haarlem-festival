<?php
require __DIR__ . '/../repositories/venuerepository.php';

class VenueService
{
    private $venueRepository;

    public function __construct()
    {
        $this->venueRepository = new VenueRepository();
    }

    public function getAll()
    {
        return $this->venueRepository->getAll();
    }

    public function getOne($id)
    {
        return $this->venueRepository->getOne($id);
    }
}
