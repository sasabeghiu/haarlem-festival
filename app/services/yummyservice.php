<?php
require __DIR__ . '/../repositories/yummyrepository.php';

class YummyService
{
    private $yummyrepository;

    public function __construct()
    {
        $this->yummyrepository = new YummyRepository();
    }
    public function getFoodPageContent()
    {
        return $this->yummyrepository->getFoodPageContent();
    }
    public function getFoodPageCards()
    {
        return $this->yummyrepository->getFoodPageCards();
    }
    public function getRestaurants()
    {
        return $this->yummyrepository->getRestaurants();
    }
    public function getRestaurantById()
    {
        return $this->yummyrepository->getRestaurantById();
    }
    public function getSessionsForRestaurant()
    {
        return $this->yummyrepository->getSessionsForRestaurant();
    }
    public function getSessions()
    {
        return $this->yummyrepository->getSessions();
    }
    public function getSessionById()
    {
        return $this->yummyrepository->getSessionById();
    }
    public function saveSession(Session $session)
    {
        $this->yummyrepository->saveSession($session);
    }
    public function deleteSession()
    {
        $this->yummyrepository->deleteSession();
    }
    public function saveRestaurant(Restaurant $restaurant)
    {
        $this->yummyrepository->saveRestaurant($restaurant);
    }
    public function saveImage(string $imgData, Restaurant $restaurant)
    {
        return $this->yummyrepository->saveImage($imgData, $restaurant);
    }
    public function deleteRestaurant()
    {
        $this->yummyrepository->deleteRestaurant();
    }
    public function getReservations()
    {
        return $this->yummyrepository->getReservations();
    }
    public function deactivateReservation()
    {
        $this->yummyrepository->deactivateReservation();
    }
    public function reservationTEMP(Reservation $reservation)
    {
        $this->yummyrepository->reservationTEMP($reservation);
    }
    public function getReservationIdByName($name)
    {
        return $this->yummyrepository->getReservationIdByName($name);
    }
}
