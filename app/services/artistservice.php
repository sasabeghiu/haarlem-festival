<?php
require __DIR__ . '/../repositories/artistrepository.php';

class ArtistService
{
    private $artistRepository;

    public function __construct()
    {
        $this->artistRepository = new ArtistRepository();
    }

    public function getAll()
    {
        return $this->artistRepository->getAll();
    }

    public function getOne($id)
    {
        return $this->artistRepository->getOne($id);
    }
}
