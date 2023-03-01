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
    public function save()
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
            $this->index();
        }
    }
}
