<?php
require __DIR__ . '/../services/yummyservice.php';

class YummyController
{
    private $yummyservice;

    public function __construct()
    {
        $this->yummyservice = new YummyService();
    }

    // public function index()
    // {
    //     $page = $this->yummyservice->getFoodPageContent();
    //     $cards = $this->yummyservice->getFoodPageCards();
    //     require __DIR__ . '/../views/food/food.php';
    // }
    public function index()
    {
        $restaurants = $this->yummyservice->getRestaurants();
        require __DIR__ . '/../views/yummy/index.php';
    }
    public function about()
    {
        $restaurant = $this->yummyservice->getRestaurantById();
        $sessions = $this->yummyservice->getSessionsForRestaurant();
        require __DIR__ . '/../views/yummy/restaurantabout.php';
    }

    //--------------------------------------------CMS functionality---------------------------------------------------------------------

    public function manageSessions()
    {
        $sessions = $this->yummyservice->getSessions();
        require __DIR__ . '/../views/cms/food/managesessions.php';
    }
    public function editSession()
    {
        $session = $this->yummyservice->getSessionById();
        require __DIR__ . '/../views/cms/food/editsession.php';
    }
    public function addSession()
    {
        $restaurants = $this->yummyservice->getRestaurants();
        require __DIR__ . '/../views/cms/food/addsession.php';
    }
    public function deleteSession()
    {
        $this->yummyservice->deleteSession();
        require __DIR__ . '/../views/cms/food/deletesession.php';
    }
    public function saveSession()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newSession = new Session();
            $newSession->setId(isset($_POST['id']) ? $_POST['id'] : 0);
            $newSession->setRestaurantid(isset($_POST['restaurantid']) ? $_POST['restaurantid'] : null); //check if information was sent, if so it assigns the value, otherwise sets to null 
            $newSession->setPrice(isset($_POST['price']) ? $_POST['price'] : null);
            $newSession->setReducedprice(isset($_POST['reducedprice']) ? $_POST['reducedprice'] : null);
            $newSession->setStarttime(isset($_POST['starttime']) ? $_POST['starttime'] : null);
            $newSession->setSession_length(isset($_POST['length']) ? $_POST['length'] : null);
            $newSession->setAvailable_seats(isset($_POST['seats']) ? $_POST['seats'] : null);

            $this->yummyservice->saveSession($newSession);
            $this->manageSessions();
        }
    }

    public function manageRestaurants()
    {
        $restaurants = $this->yummyservice->getRestaurants();
        require __DIR__ . '/../views/cms/food/managerestaurants.php';
    }
    public function editRestaurant()
    {
        $restaurant = $this->yummyservice->getRestaurantById();
        require __DIR__ . '/../views/cms/food/editrestaurant.php';
    }
    public function addRestaurant()
    {
        require __DIR__ . '/../views/cms/food/addrestaurant.php';
    }
    public function deleteRestaurant()
    {
        $this->yummyservice->deleteRestaurant();
        require __DIR__ . '/../views/cms/food/deleterestaurant.php';
    }
    public function saveRestaurant()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newRestaurant = new Restaurant();
            $newRestaurant->setId(isset($_POST['id']) ? $_POST['id'] : 0);
            $newRestaurant->setName(isset($_POST['name']) ? $_POST['name'] : null);
            $newRestaurant->setLocation(isset($_POST['location']) ? $_POST['location'] : null);
            $newRestaurant->setDescription(isset($_POST['description']) ? $_POST['description'] : null);
            $newRestaurant->setCuisine(isset($_POST['cuisine']) ? $_POST['cuisine'] : null);
            $newRestaurant->setStars(isset($_POST['stars']) ? $_POST['stars'] : null);
            $newRestaurant->setEmail(isset($_POST['email']) ? $_POST['email'] : null);
            $newRestaurant->setPhonenumber(isset($_POST['phonenumber']) ? $_POST['phonenumber'] : null);

            if (count($_FILES) > 0) {
                for ($i = 1; $i <= 3; $i++) {
                    if (is_uploaded_file($_FILES['image' . $i]['tmp_name'])) {
                        $imgData = file_get_contents($_FILES['image' . $i]['tmp_name']);
                        $setMethod = "setImage" . $i;
                        $newRestaurant->$setMethod($this->yummyservice->saveImage($imgData, $newRestaurant));
                    }
                }
            }

            $this->yummyservice->saveRestaurant($newRestaurant);

            $this->manageRestaurants();
        }
    }
    public function manageReservations()
    {
        $reservations = $this->yummyservice->getReservations();
        require __DIR__ . '/../views/cms/food/managereservations.php';
    }
    public function deactivateReservation()
    {
        $this->yummyservice->deactivateReservation();
        require __DIR__ . '/../views/cms/food/deactivatereservation.php';
    }
    public function reservationTEMP()
    {
        $restaurantid = htmlspecialchars($_GET['restaurantid']);

        $reservation = new Reservation();
        $reservation->setName(isset($_POST['name']) ? $_POST['name'] : null);
        $reservation->setRestaurantID($restaurantid);
        $reservation->setSessionID(isset($_POST['session']) ? $_POST['session'] : null);
        $seats = $_POST['formguestsadult'] + $_POST['formguestskids'];
        $reservation->setSeats($seats);

        $datetime = $_POST['date'] . " " . $_POST['session'];
        $reservation->setDate($datetime);
        $reservation->setRequest(isset($_POST['request']) ? $_POST['request'] : "None");
        $reservation->setPrice($seats * 10);

        $this->yummyservice->reservationTEMP($reservation);

        header('Location: /yummy');
    }
}
