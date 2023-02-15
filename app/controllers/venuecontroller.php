<?php
require __DIR__ . '/../services/venueservice.php';

class VenueController 
{
    private $venueService;

    function __construct()
    {
        $this->venueService = new VenueService();
    }

    public function index()
    {
        $model = $this->venueService->getAll();

        require __DIR__ . '/../views/music/venue.php';
    }
}