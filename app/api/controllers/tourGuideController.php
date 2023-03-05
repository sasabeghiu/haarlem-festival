<?php

require __DIR__ . '/../../services/tourGuideService.php';

class TourGuideController
{

    private $tourguideService;

    function __construct()
    {
        $this->tourguideService = new TourGuideService();
    }

    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: *");

        if ($_SERVER["REQUEST_METHOD"] == "GET"){
            $tourguides = $this->tourguideService->getAll();
            header('Content-Type: application/json');
            echo json_encode($tourguides);
        }
    }
}