<?php

require __DIR__ . '/../repositories/tourguidecmsrepository.php';

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

    public function addTourguide(TourGuideCms $tourguides)
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

    public function saveImage($imgInfo)
    {
        return $this->tourguideRepository->saveImage($imgInfo);
    }

    public function updateImage($imgInfo, $id)
    {
        return $this->tourguideRepository->updateImage($imgInfo, $id);
    }

    public function getATourguide($id)
    {
        return $this->tourguideRepository->getATourguide($id);
    }
}