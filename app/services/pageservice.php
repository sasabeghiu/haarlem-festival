<?php
require __DIR__ . '/../repositories/pagerepository.php';

class PageService
{
    private $pageRepository;

    public function __construct()
    {
        $this->pageRepository = new PageRepository();
    }
}
