<?php
require __DIR__ . '/../services/venueservice.php';
include_once __DIR__ . '/../views/getURL.php';

class VenueController
{
    private $venueService;

    function __construct()
    {
        $this->venueService = new VenueService();
    }

    public function index()
    {
        $model = $this->venueService->getAll();

        require __DIR__ . '/../views/dance/venuesoverview.php';
    }

    public function venuedetails()
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->venueService->getOne($params['id']);

        require __DIR__ . '/../views/dance/venuedetails.php';
    }

    public function venuecms()
    {
        //delete
        if (isset($_POST["delete"])) {
            $id = htmlspecialchars($_GET["deleteID"]);
            $this->venueService->deleteVenue($id);

            if ($this->venueService) {
                echo "<script>alert('Venue deleted successfully. ')</script>";
            } else {
                echo "<script>alert('Failed to delete Venue. ')</script>";
            }
        }
        //add
        if (isset($_POST["add"])) {
            $name = htmlspecialchars($_POST["name"]);
            $description = htmlspecialchars($_POST["description"]);
            $type = htmlspecialchars($_POST["type"]);
            $image = htmlspecialchars($_POST["image"]);

            $venue = new Venue();

            $venue->setName($name);
            $venue->setDescription($description);
            $venue->setType($type);
            $venue->setImage($image);

            $this->venueService->addVenue($venue);

            if ($this->venueService) {
                echo "<script>alert('Venue addedd successfully. ')</script>";
            } else {
                echo "<script>alert('Failed to add Venue. ')</script>";
            }
        }
        //edit
        if (isset($_POST["edit"])) {
            $id = htmlspecialchars($_GET["updateID"]);
            $updateVenue = $this->venueService->getOne($id);
        }
        //update
        if (isset($_POST["update"])) {
            $name = htmlspecialchars($_POST["changedName"]);
            $description = htmlspecialchars($_POST["changedDescription"]);
            $type = htmlspecialchars($_POST["changedType"]);
            $image = htmlspecialchars($_POST["changedImage"]);

            $venue = new Venue();

            $venue->setName($name);
            $venue->setDescription($description);
            $venue->setType($type);
            $venue->setImage($image);

            $this->venueService->updateVenue($venue, $_GET["updateID"]);

            if ($this->venueService) {
                echo "<script>alert('Venue updated successfully. ')</script>";
            } else {
                echo "<script>alert('Failed to update Venue. ')</script>";
            }
        }

        $model = $this->venueService->getAll();

        require __DIR__ . '/../views/cms/venue-cms.php';
    }
}
