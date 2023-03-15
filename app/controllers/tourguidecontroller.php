<?php

require __DIR__ . '/../services/tourguideservice.php';

class TourGuideController
{

    private $tourguideService;

    function __construct()
    {
        $this->tourguideService = new TourGuideService();   
    }

    public function index()
    {
        // retrieve data
        $model = $this->tourguideService->getAll();

        require __DIR__ . '/../views/tourguide/index.php';
    }
}
