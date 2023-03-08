<?php
require __DIR__ . '/../repositories/pagecardrepository.php';

class PageCardService
{
    private $pageCardRepository;

    public function __construct()
    {
        $this->pageCardRepository = new PageCardRepository();
    }
}
