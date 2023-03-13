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

    public function theaterpage()
    {
        $page = $this->pageController->getOnePage(5);
        $pagecards = $this->pageCardController->getAllCardsByPageId(5);

        require __DIR__ . '/../views/visithaarlem/theater.php';
    }

    public function musicpage()
    {
        $page = $this->pageController->getOnePage(6);
        $pagecards = $this->pageCardController->getAllCardsByPageId(6);

        require __DIR__ . '/../views/visithaarlem/music.php';
    }
}
