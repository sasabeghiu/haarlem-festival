<?php
require __DIR__ . '/../services/foodservice.php';

class FoodController{
    private $foodService;

    public function __construct()
    {
        $this->foodService = new FoodService();
    }

    public function index(){
        require __DIR__ . '/../views/home/food.php';
    }
    public function about() {
        $restaurants = $this->foodService->getRestaurantById();
        require __DIR__ . '/../views/home/restaurantabout.php';
    }
    public function yummy(){
        $restaurants = $this->foodService->getRestaurants();
        require __DIR__ . '/../views/home/yummy.php';

    }
    public function manageSessions() {
        $sessions = $this->foodService->getSessions();
        require __DIR__ . '/../views/cms/food/managesessions.php';
    }
}