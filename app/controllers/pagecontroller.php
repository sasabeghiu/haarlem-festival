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

    public function historypage()
    {
        $page = $this->pageController->getOnePage(3);
        $pagecards = $this->pageCardController->getAllCardsByPageId(3);

        require __DIR__ . '/../views/visithaarlem/history.php';
    }

    public function museumpage()
    {
        $page = $this->pageController->getOnePage(4);
        $pagecards = $this->pageCardController->getAllCardsByPageId(4);

        require __DIR__ . '/../views/visithaarlem/museum.php';
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
