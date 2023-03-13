<?php
require __DIR__ . '/../repositories/tourguiderepository.php';

class TourGuideService
{
    private $tourguideRepository;

    function __construct()
    {
        $this->tourguideRepository = new TourGuideRepository();   
    }

    public function getAll()
    {
        // retrieve data
        return $this->tourguideRepository->getAll();
    }
}
