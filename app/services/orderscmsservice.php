<?php

require __DIR__ . '/../repositories/orderscmsrepository.php';

class OrdersCmsService 
{
    private $placeordercmsRepository;

    public function __construct()
    {
        $this->placeordercmsRepository = new OrdersCmsRepository();
    }

    public function getAll()
    {
        return $this->placeordercmsRepository->getAll();
    }

    public function getOneOrder($id)
    {
        return $this->placeordercmsRepository->getOneOrder($id);
    }

    public function updatePlacedOrder($placedorder, $id)
    {
        return $this->placeordercmsRepository->updatePlacedOrder($placedorder, $id);
    }
}