<?php
require __DIR__ . '/../repositories/imagerepository.php';

class ImageService
{
    private $imageRepository;

    public function __construct()
    {
        $this->imageRepository = new ImageRepository();
    }

    public function getOne($id)
    {
        return $this->imageRepository->getOne($id);
    }

    public function addImage($image)
    {
        return $this->imageRepository->addImage($image);
    }
}
