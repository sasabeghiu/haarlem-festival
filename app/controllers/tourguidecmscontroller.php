<?php
require __DIR__ . '/../services/tourguidecmsservice.php';

include_once __DIR__ . '/../views/getURL.php';

class TourGuideCmsController
{
    private $tourguideService;

    function __construct()
    {
        $this->tourguideService = new TourGuideCmsService();
    }

    public function tourGuideDetails()
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->tourguideService->getOne($params['id']);

        require __DIR__ . '/../views/cms/tourguide/index.php';
    }


    public function cms()
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

            if (count($_FILES) > 0) {
                if (is_uploaded_file($_FILES['image']['tmp_name'])){
                    $image = file_get_contents($_FILES['image']['tmp_name']);
                    $tourguidescms->setImage($this->tourguideService->saveImage($image));
                }
            } else {
                echo "Problem Occured!";
            }

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
            $updateTourguide = $this->tourguideService->getOne($id);
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

            $theTourguide = $this->tourguideService->getATourguide($_GET["updateID"]);
            if (count($_FILES) > 0) {
                if (is_uploaded_file($_FILES['changeImage']['tmp_name'])) {
                    $image = file_get_contents($_FILES['changeImage']['tmp_name']);
                    $tourguidescms->setImage($this->tourguideService->updateImage($image, $theTourguide->getImage()));
                }
            } else {
                echo "Problem Occured!";
            }

            $this->tourguideService->updateTourguide($tourguidescms, $_GET["updateID"]);

            if ($this->tourguideService) {
                echo "<script>alert('Tour Guide updated successfully! ')</script>";
            } else {
                echo "<script>alert('Failed to update Tour Guide. ')</script>";
            }
        }
        $model = $this->tourguideService->getAll();


        require __DIR__ . '/../views/cms/tourguide/index.php';
    }
}
