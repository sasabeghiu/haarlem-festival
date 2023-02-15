<?php
require __DIR__ . '/../services/artistservice.php';

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

        require __DIR__ . '/../views/music/artist.php';
    }
}
