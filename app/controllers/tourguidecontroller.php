<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/tourguideservice.php';

class TourGuideController extends Controller
{

    private $tourguideService;

    function __construct()
    {
        $this->tourguideService = new TourGuideService();
    }

    public function index()
    {

        $model = $this->tourguideService->getAll();

        //$this->displayView($tourguides);
        require __DIR__ . '/../views/tourguide/index.php';
    }
}
