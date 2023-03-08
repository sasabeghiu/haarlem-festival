<?php
require __DIR__ . '/../services/pageservice.php';
require __DIR__ . '/../services/pagecardservice.php';

class PageController
{
    private $pageController;
    private $pageCardController;

    function __construct()
    {
        $this->pageController = new PageService();
        $this->pageCardController = new PageCardService();
    }
}
