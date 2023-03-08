<?php
require __DIR__ . '/../services/venueservice.php';
require __DIR__ . '/../services/eventservice.php';

include_once __DIR__ . '/../views/getURL.php';

class VenueController
{
    private $venueService;
    private $eventService;

    function __construct()
    {
        $this->venueService = new VenueService();
        $this->eventService = new EventService();
    }

    public function dancevenues()
    {
        $model = $this->venueService->getAllDanceVenues();

        require __DIR__ . '/../views/dance/venuesoverview.php';
    }

    public function jazzvenues()
    {
        $model = $this->venueService->getAllJazzVenues();

        require __DIR__ . '/../views/jazz/venuesoverview.php';
    }

    public function dancevenuedetails()
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->venueService->getOne($params['id']);
        $events = $this->eventService->getEventsByVenueID($params['id']);


        require __DIR__ . '/../views/dance/venuedetails.php';
    }

    public function jazzvenuedetails()
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->venueService->getOne($params['id']);
        $events = $this->eventService->getEventsByVenueID($params['id']);


        require __DIR__ . '/../views/jazz/venuedetails.php';
    }

    // cms part

    public function addVenue()
    {
        $name = htmlspecialchars($_POST["name"]);
        $description = htmlspecialchars($_POST["description"]);
        $type = htmlspecialchars($_POST["type"]);

        $venue = new Venue();

        $venue->setName($name);
        $venue->setDescription($description);
        $venue->setType($type);


        if (count($_FILES) > 0) {
            if (is_uploaded_file($_FILES['image1']['tmp_name'])) {
                $img = file_get_contents($_FILES['image1']['tmp_name']);
                $id = $this->venueService->saveImage($img);
                $venue->setImage($id);
            }
            if (is_uploaded_file($_FILES['headerImg']['tmp_name'])) {
                $img11 = file_get_contents($_FILES['headerImg']['tmp_name']);
                $venue->setHeaderImg($this->venueService->saveImage($img11));
            }
        } else {
            echo "problem";
        }

        $this->venueService->addVenue($venue);

        if ($this->venueService) {
            echo "<script>alert('Venue addedd successfully. ')</script>";
        } else {
            echo "<script>alert('Failed to add Venue. ')</script>";
        }
    }

    public function updateVenue()
    {
        $name = htmlspecialchars($_POST["changedName"]);
        $description = htmlspecialchars($_POST["changedDescription"]);
        $type = htmlspecialchars($_POST["changedType"]);

        $venue = new Venue();

        $venue->setName($name);
        $venue->setDescription($description);
        $venue->setType($type);

        $thisVenue = $this->venueService->getAVenue($_GET["updateID"]);
        if (count($_FILES) > 0) {
            if (is_uploaded_file($_FILES['changedImage']['tmp_name'])) {
                $img = file_get_contents($_FILES['changedImage']['tmp_name']);
                $venue->setImage($this->venueService->updateImage($img, $thisVenue->getImage()));
            }
            if (is_uploaded_file($_FILES['changedHeaderImage']['tmp_name'])) {
                $img11 = file_get_contents($_FILES['changedHeaderImage']['tmp_name']);
                $venue->setHeaderImg($this->venueService->updateImage($img11, $thisVenue->getHeaderImg()));
            }
        } else {
            echo "problem";
        }

        $this->venueService->updateVenue($venue, $_GET["updateID"]);

        if ($this->venueService) {
            echo "<script>alert('Venue updated successfully. ')</script>";
        } else {
            echo "<script>alert('Failed to update Venue. ')</script>";
        }
    }

    public function deleteVenue()
    {
        $id = htmlspecialchars($_GET["deleteID"]);
        $this->venueService->deleteVenue($id);

        if ($this->venueService) {
            echo "<script>alert('Venue deleted successfully. ')</script>";
        } else {
            echo "<script>alert('Failed to delete Venue. ')</script>";
        }
    }

    public function venuecms()
    {
        if (isset($_POST["delete"])) {
            $this->deleteVenue();
        }
        if (isset($_POST["add"])) {
            $this->addVenue();
        }
        if (isset($_POST["edit"])) {
            $id = htmlspecialchars($_GET["updateID"]);
            $updateVenue = $this->venueService->getOne($id);
        }
        if (isset($_POST["update"])) {
            $this->updateVenue();
        }

        //sort venues by type dance or jazz
        if (isset($_POST["dance"])) {
            $model = $this->venueService->getAllDanceVenues();
        } else if (isset($_POST["jazz"])) {
            $model = $this->venueService->getAllJazzVenues();
        } else {
            $model = $this->venueService->getAll();
        }

        require __DIR__ . '/../views/cms/music/venue-cms.php';
    }
}
