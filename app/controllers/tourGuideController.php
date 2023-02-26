<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/tourGuideService.php';

class TourGuideController extends Controller{

    private $tourguideService;

    function __construct()
    {
        $this->tourguideService = new TourGuideService();
    }

    public function index()
    {

        $tourguides = $this->tourguideService->getAll();

        $this->displayView($tourguides);
        //require __DIR__ . '/../views/tourguide/index.php';
    }
}