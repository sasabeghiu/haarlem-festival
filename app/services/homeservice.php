<?php
require __DIR__ . '/../repositories/homerepository.php';

class HomeService
{
    private $homeRepository;

    public function __construct()
    {
        $this->homeRepository = new HomeRepository();
    }

    public function getAll()
    {
        return $this->homeRepository->getAll();
    }
}
