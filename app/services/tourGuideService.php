<?php
require __DIR__ . '/../repositories/tourGuideRepository.php';

class TourGuideService
{
    public function getAll()
    {
        //retrieve data
        $repository = new TourGuideRepository();
        $tourguides = $repository->getAll();
        return $tourguides;
    }

    public function insert($tourguide)
    {
        // retrieve data
        $repository = new TourGuideRepository();
        $repository->insert($tourguide);
    }
}
