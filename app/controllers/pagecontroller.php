<?php
require __DIR__ . '/../services/pageservice.php';
require __DIR__ . '/../services/pagecardservice.php';

class PageController
{
    private $pageService;
    private $pageCardService;

    function __construct()
    {
        $this->pageService = new PageService();
        $this->pageCardService = new PageCardService();
    }

    public function historypage()
    {
        $page = $this->pageService->getOnePage(3);
        $pagecards = $this->pageCardService->getAllCardsByPageId(3);

        require __DIR__ . '/../views/visithaarlem/history.php';
    }

    public function museumpage()
    {
        $page = $this->pageService->getOnePage(4);
        $pagecards = $this->pageCardService->getAllCardsByPageId(4);

        require __DIR__ . '/../views/visithaarlem/museum.php';
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
