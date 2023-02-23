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

    public function getOneArtistByName($name)
    {
        return $this->artistRepository->getOneArtistByName($name);
    }

    public function addArtist($artist)
    {
        return $this->artistRepository->addArtist($artist);
    }

    public function updateArtist($artist, $id)
    {
        return $this->artistRepository->updateArtist($artist, $id);
    }

    public function deleteArtist($id)
    {
        return $this->artistRepository->deleteArtist($id);
    }
}
