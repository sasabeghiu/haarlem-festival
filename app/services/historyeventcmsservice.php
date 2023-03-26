<?php

require __DIR__ . '/../repositories/historyeventcmsrepository.php';

class HistoryEventCmsService
{
    private $historyeventRepository;

    public function __construct()
    {
        $this->historyeventRepository = new HistoryEventCmsRepository();
    }

    public function getAll()
    {
        return $this->historyeventRepository->getAll();
    }

    public function getOne($id)
    {
        return $this->historyeventRepository->getOne($id);
    }

    public function addHistoryEvent(HistoryEventCms $historyevent)
    {
        return $this->historyeventRepository->addHistoryEvent($historyevent);
    }

    public function updateHistoryEvent($historyevent, $id)
    {
        return $this->historyeventRepository->updateHistoryEvent($historyevent, $id);
    }

    public function deleteHistoryEvent($id)
    {
        return $this->historyeventRepository->deleteHistoryEvent($id);
    }

    public function saveImage($imgInfo)
    {
        return $this->historyeventRepository->saveImage($imgInfo);
    }

    public function updateImage($imgInfo, $id)
    {
        return $this->historyeventRepository->updateImage($imgInfo, $id);
    }

    public function getAHistoryEvent($id)
    {
        return $this->historyeventRepository->getAHistoryEvent($id);
    }
}