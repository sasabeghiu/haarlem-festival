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
    public function saveImage(string $imgData, Restaurant $restaurant){
        return $this->foodRepository->saveImage($imgData, $restaurant);
    }
    public function deleteRestaurant() {
        $this->foodRepository->deleteRestaurant();
    }
    public function getReservations() {
        return $this->foodRepository->getReservations();
    }
    public function deactivateReservation() {
        $this->foodRepository->deactivateReservation();
    }
}
