<?php
require __DIR__ . '/../services/pageservice.php';
require __DIR__ . '/../services/pagecardservice.php';

require __DIR__ . '/../services/eventservice.php';
require __DIR__ . '/../services/historyeventservice.php';

class PageController
{
    private $pageService;
    private $pageCardService;
    private $eventService;
    private $historyEventService;

    function __construct()
    {
        $this->pageService = new PageService();
        $this->pageCardService = new PageCardService();
        $this->eventService = new EventService();
        $this->historyEventService = new HistoryEventService();
    }

    public function theaterpage()
    {
        $page = $this->pageService->getOnePage(5);
        $pagecards = $this->pageCardService->getAllCardsByPageId(5);

        require __DIR__ . '/../views/visithaarlem/theater.php';
    }

    public function musicpage()
    {
        $page = $this->pageService->getOnePage(6);
        $pagecards = $this->pageCardService->getAllCardsByPageId(6);

        require __DIR__ . '/../views/visithaarlem/music.php';
    }

    public function homepage()
    {
        $page = $this->pageService->getOnePage(1);
        $pagecards = $this->pageCardService->getAllCardsByPageId(1);

        require __DIR__ . '/../views/visithaarlem/homepage.php';
    }

    public function festivalpage()
    {
        $page = $this->pageService->getOnePage(2);
        $pagecards = $this->pageCardService->getAllCardsByPageId(2);

        $events = $this->eventService->getAll();
        $historyEvents = $this->historyEventService->getAll();

        require __DIR__ . '/../views/home/homepage.php';
    }
}
