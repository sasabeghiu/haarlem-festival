<?php
require __DIR__ . '/../services/venueservice.php';
include_once __DIR__ . '/../views/getURL.php';

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

        require __DIR__ . '/../views/dance/venuesoverview.php';
    }

    public function venuedetails()
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->venueService->getOne($params['id']);

        require __DIR__ . '/../views/dance/venuedetails.php';
    }
}
