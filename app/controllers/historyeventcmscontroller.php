<?php
require __DIR__ . '/../services/historyeventcmsservice.php';

include_once __DIR__ . '/../views/getURL.php';

class HistoryEventCmsController
{
    private $historyeventService;

    function __construct()
    {
        $this->historyeventService = new HistoryEventCmsService();
    }

    public function historyEventDetails()
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->historyeventService->getOne($params['id']);

        require __DIR__ . '/../views/cms/historyevent/index.php';
    }


    public function cms()
    {

        //Functionality delete
        if (isset($_POST["delete"])) {
            $id = htmlspecialchars($_GET["deleteID"]);
            $this->historyeventService->deleteHistoryEvent($id);

            if ($this->historyeventService) {
                echo "<script>alert('History Event deleted successfully! ')</script>";
            } else {
                echo "<script>alert('Failed to delete History Event. ')</script>";
            }
        }
        //Functionality Add
        if (isset($_POST["add"])) {

            $tickets_available = htmlspecialchars($_POST["tickets_available"]);
            $price = htmlspecialchars($_POST["price"]);
            $datetime = htmlspecialchars($_POST["datetime"]);
            $location = htmlspecialchars($_POST["location"]);
            $tourguideID = htmlspecialchars($_POST["tourguideID"]);

            $historyeventcms = new HistoryEventCms();

            $historyeventcms->setTicketsAvailable($$tickets_available);
            $historyeventcms->setPrice($price);
            $historyeventcms->setDateTime($datetime);
            $historyeventcms->setLocation($location);
            $historyeventcms->setTourguideID($tourguideID);

            if (count($_FILES) > 0) {
                if (is_uploaded_file($_FILES['image']['tmp_name'])){
                    $image = file_get_contents($_FILES['image']['tmp_name']);
                    $historyeventcms->setImage($this->historyeventService->saveImage($image));
                }
            } else {
                echo "Problem Occured! ";
            }

            $this->historyeventService->addHistoryEvent($historyeventcms);

            if ($this->historyeventService) {
                echo "<script>alert('History Event added successfully! ')</script>";
            } else {
                echo "<script>alert('Failed to add History Event. ')</script>";
            }
        }
        //Functionality editing
        if (isset($_POST["edit"])) {
            $id = htmlspecialchars($_GET["updateID"]);
            $updateHistoryEvent = $this->historyeventService->getOne($id);
        }
        //Functionality update
        if (isset($_POST["update"])) {
            $tickets_available = htmlspecialchars($_POST["changedTickets_available"]);
            $price = htmlspecialchars($_POST["changedPrice"]);
            $datetime = htmlspecialchars($_POST["changedDatetime"]);
            $location = htmlspecialchars($_POST["changedLocation"]);
            $tourguideID = htmlspecialchars($_POST["changedTourguideID"]);

            $historyeventcms = new HistoryEventCms();

            $historyeventcms->setTicketsAvailable($$tickets_available);
            $historyeventcms->setPrice($price);
            $historyeventcms->setDateTime($datetime);
            $historyeventcms->setLocation($location);
            $historyeventcms->setTourguideID($tourguideID);

            $theHistoryEvent = $this->historyeventService->getAHistoryEvent($_GET["updateID"]);
            if (count($_FILES) > 0) {
                if (is_uploaded_file($_FILES['changeImage']['tmp_name'])) {
                    $image = file_get_contents($_FILES['changeImage']['tmp_name']);
                    $historyeventcms->setImage($this->historyeventService->updateImage($image, $theHistoryEvent->getImage()));
                }
            } else {
                echo "Problem Occured!";
            }

            $this->historyeventService->updateHistoryEvent($historyeventcms, $_GET["updateID"]);

            if ($this->historyeventService) {
                echo "<script>alert('History Event updated successfully! ')</script>";
            } else {
                echo "<script>alert('Failed to update History Event. ')</script>";
            }
        }
        $model = $this->historyeventService->getAll();


        require __DIR__ . '/../views/cms/historyevent/index.php';
    }
}