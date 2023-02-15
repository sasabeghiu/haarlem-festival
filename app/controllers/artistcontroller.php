<?php
require __DIR__ . '/../services/artistservice.php';
include_once __DIR__ . '/../views/getURL.php';

class ArtistController
{
    private $artistService;

    function __construct()
    {
        $this->artistService = new ArtistService();
    }

    public function index()
    {
        $model = $this->artistService->getAll();

        require __DIR__ . '/../views/dance/artistsoverview.php';
    }

    public function artistdetails()
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->artistService->getOne($params['id']);

        require __DIR__ . '/../views/dance/artistdetails.php';
    }
}
