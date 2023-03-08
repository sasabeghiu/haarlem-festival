<?php
require __DIR__ . '/controller.php';

require __DIR__ . '/../services/tourGuideCmsService.php';

include_once __DIR__ . '/../views/getURL.php';

class TourGuideCmsController extends Controller
{
    private $tourguideService;

    function __construct()
    {
        $this->tourguideService = new TourGuideCmsService();
    }

    public function index()
    {
        $tourguidecms = $this->tourguideService->getAll();

        $this->displayView($tourguidecms);
    }

    public function tourGuideDetails()
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->tourguideService->getOne($params['id']);

        //a require is needed most likely here.
    }

    public function tourGuideCms()
    {
        //Functionality delete
        if (isset($_POST["delete"])) {
            $id = htmlspecialchars($_GET["deleteID"]);
            $this->tourguideService->deleteTourguide($id);

            if ($this->tourguideService) {
                echo "<script>alert('Tour Guide deleted successfully! ')</script>";
            } else {
                echo "<script>alert('Failed to delete Tour Guide. ')</script>";
            }
        }
        //Functionality Add
        if (isset($_POST["add"])) {
            $name = htmlspecialchars($_POST["name"]);
            $description = htmlspecialchars($_POST["description"]);
            $image = htmlspecialchars($_POST["image"]);

            $tourguidescms = new TourGuideCms();

            $tourguidescms->setName($name);
            $tourguidescms->setDescription($description);
            $tourguidescms->setImage($image);

            $this->tourguideService->addTourguide($tourguidescms);

            if ($this->tourguideService) {
                echo "<script>alert('Tour Guide added successfully! ')</script>";
            } else {
                echo "<script>alert('Failed to add Tour Guide. ')</script>";
            }
        }
        //Functionality editing
        if (isset($_POST["edit"])) {
            $id = htmlspecialchars($_GET["updateID"]);
            $updateTourGuide = $this->tourguideService->getOne($id);
        }
        //Functionality update
        if (isset($_POST["update"])) {
            $name = htmlspecialchars($_POST["changedName"]);
            $description = htmlspecialchars($_POST["changedDescription"]);
            $image = htmlspecialchars($_POST["changedImage"]);

            $tourguidescms = new TourGuideCms();

            $tourguidescms->setName($name);
            $tourguidescms->setDescription($description);
            $tourguidescms->setImage($image);

            $this->tourguideService->updateTourguide($tourguidescms, $_GET["updateID"]);

            if ($this->tourguideService) {
                echo "<script>alert('Tour Guide updated successfully! ')</script>";
            } else {
                echo "<script>alert('Failed to update Tour Guide. ')</script>";
            }
        }

        /*$model = $this->tourguideService->getAll();

        require __DIR__ . '/../views/cms/artist-cms.php';*/
    }
}