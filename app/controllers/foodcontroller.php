<?php
require __DIR__ . '/../services/foodservice.php';

class FoodController
{
    private $foodService;

    public function __construct()
    {
        $this->foodService = new FoodService();
    }

    public function index()
    {
        require __DIR__ . '/../views/food/food.php';
    }
    public function about()
    {
        $restaurant = $this->foodService->getRestaurantById();
        require __DIR__ . '/../views/food/restaurantabout.php';
    }
    public function yummy()
    {
        $restaurants = $this->foodService->getRestaurants();
        require __DIR__ . '/../views/food/yummy.php';
    }

    //--------------------------------------------CMS functionality---------------------------------------------------------------------

    public function manageSessions()
    {
        $sessions = $this->foodService->getSessions();
        require __DIR__ . '/../views/cms/food/managesessions.php';
    }
    public function editSession()
    {
        $session = $this->foodService->getSessionById();
        require __DIR__ . '/../views/cms/food/editsession.php';
    }
    public function addSession() {
        $restaurants = $this->foodService->getRestaurants();
        require __DIR__ .'/../views/cms/food/addsession.php';
    }
    public function deleteSession() {
        $this->foodService->deleteSession();
        require __DIR__ . '/../views/cms/food/deletesession.php';
    }
    public function saveSession()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newSession = new Session();
            $newSession->setId(isset($_POST['id']) ? $_POST['id'] : 0);
            $newSession->setRestaurantid(isset($_POST['restaurantid']) ? $_POST['restaurantid'] : null); //check if information was sent, if so it assigns the value, otherwise sets to null 
            $newSession->setSessions(isset($_POST['sessions']) ? $_POST['sessions'] : null);
            $newSession->setPrice(isset($_POST['price']) ? $_POST['price'] : null);
            $newSession->setReducedprice(isset($_POST['reducedprice']) ? $_POST['reducedprice'] : null);
            $newSession->setFirst_session(isset($_POST['firstsession']) ? $_POST['firstsession'] : null);
            $newSession->setSession_length(isset($_POST['length']) ? $_POST['length'] : null);
            $newSession->setSeats(isset($_POST['seats']) ? $_POST['seats'] : null);

            $this->foodService->saveSession($newSession);
            $this->manageSessions();
        }
    }

    public function manageRestaurants()
    {
        $restaurants = $this->foodService->getRestaurants();
        require __DIR__ . '/../views/cms/food/managerestaurants.php';
    }
    public function editRestaurant()
    {
        $restaurant = $this->foodService->getRestaurantById();
        require __DIR__ . '/../views/cms/food/editrestaurant.php';
    }
    public function addRestaurant() {
        require __DIR__ .'/../views/cms/food/addrestaurant.php';    
    }
    public function deleteRestaurant() {
        $this->foodService->deleteRestaurant();
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
                for($i = 1; $i <= 3; $i++){
                    if (is_uploaded_file($_FILES['image' . $i]['tmp_name'])) {
                        $imgData = file_get_contents($_FILES['image' . $i]['tmp_name']);
                        $setMethod = "setImage" . $i;
                        $newRestaurant->$setMethod($this->foodService->saveImage($imgData, $newRestaurant));
                }
                
            }}

            $this->foodService->saveRestaurant($newRestaurant);

            $this->manageRestaurants();
        }
    }
    public function manageReservations() {
        $reservations = $this->foodService->getReservations();
        require __DIR__ . '/../views/cms/food/managereservations.php';
    }
}
