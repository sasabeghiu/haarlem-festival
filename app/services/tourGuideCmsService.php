<?php

require __DIR__ . '/../repositories/tourGuideCmsRepository.php';

class TourGuideCmsService
{
    private $tourguideRepository;

    public function __construct()
    {
        $this->tourguideRepository = new TourGuideCmsRepository();
    }

    public function getAll()
    {
        return $this->tourguideRepository->getAll();
    }

    public function getOne($id)
    {
        return $this->tourguideRepository->getOne($id);
    }

    public function getOneTourguideByName($name)
    {
        return $this->tourguideRepository->getOneTourguideByName($name);
    }

    public function addTourguide($tourguides)
    {
        return $this->tourguideRepository->addTourguide($tourguides);
    }

    public function updateTourguide($tourguides, $id)
    {
        return $this->tourguideRepository->updateTourguide($tourguides, $id);
    }

    public function deleteTourguide($id)
    {
        return $this->tourguideRepository->deleteTourguide($id);
    }
}