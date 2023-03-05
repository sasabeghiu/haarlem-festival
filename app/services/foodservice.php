<?php
require __DIR__ . '/../repositories/foodrepository.php';

class FoodService
{
    private $foodRepository;

    public function __construct()
    {
        $this->foodRepository = new FoodRepository();
    }
    public function getRestaurants()
    {
        return $this->foodRepository->getRestaurants();
    }
    public function getRestaurantById()
    {
        return $this->foodRepository->getRestaurantById();
    }
    public function getSessions(){
        return $this->foodRepository->getSessions();
    }
    public function getSessionById() {
        return $this->foodRepository->getSessionById();
    }
    public function saveSession(Session $session) {
        $this->foodRepository->saveSession($session);
    }
    public function deleteSession() {
        $this->foodRepository->deleteSession();
    }
    public function saveRestaurant(Restaurant $restaurant) {
        $this->foodRepository->saveRestaurant($restaurant);
    }
    public function saveImages(string $imgData, Restaurant $restaurant){
        $this->foodRepository->saveImages($imgData, $restaurant);
    }
}
