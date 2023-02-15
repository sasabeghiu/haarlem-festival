<?php
class FoodController{
    public function index(){
        require __DIR__ . '/../views/home/food.php';
    }
    public function about() {
        require __DIR__ . '/../views/home/restaurantabout.php';
    }
}