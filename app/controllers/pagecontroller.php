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

    public function index()
    {
        $page = $this->pageService->getOnePage(1);
        $pagecards = $this->pageCardService->getAllCardsByPageId(1);

        require __DIR__ . '/../views/visithaarlem/homepage.php';
    }

    public function festival()
    {
        $page = $this->pageService->getOnePage(2);
        $pagecards = $this->pageCardService->getAllCardsByPageId(2);

        $events = $this->eventService->getAll();
        $historyEvents = $this->historyEventService->getAll();

        require __DIR__ . '/../views/home/homepage.php';
    }

    public function history()
    {
        $page = $this->pageService->getOnePage(3);
        $pagecards = $this->pageCardService->getAllCardsByPageId(3);

        require __DIR__ . '/../views/visithaarlem/history.php';
    }

    public function museum()
    {
        $page = $this->pageService->getOnePage(4);
        $pagecards = $this->pageCardService->getAllCardsByPageId(4);

        require __DIR__ . '/../views/visithaarlem/museum.php';
    }

    public function theater()
    {
        $page = $this->pageService->getOnePage(5);
        $pagecards = $this->pageCardService->getAllCardsByPageId(5);

        require __DIR__ . '/../views/visithaarlem/theater.php';
    }

    public function music()
    {
        $page = $this->pageService->getOnePage(6);
        $pagecards = $this->pageCardService->getAllCardsByPageId(6);

        if (isset($_POST["update"])) {
            $this->updateMusicPage();
        }

        require __DIR__ . '/../views/visithaarlem/music.php';
    }

    public function updateMusicPage()
    {
        $title = htmlspecialchars($_POST["title"]);
        $description = htmlspecialchars($_POST["description"]);

        $page = new Page();

        $page->setHeaderImg('');
        $page->setTitle($title);
        $page->setDescription($description);

        $this->pageService->updatePage($page, 6);
    }
}
