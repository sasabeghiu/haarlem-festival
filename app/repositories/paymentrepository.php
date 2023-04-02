<?php
require __DIR__ . '/../repositories/repository.php';
require __DIR__ . '/../models/reservation.php';
require __DIR__ . '/../models/api_key.php';

class PaymentRepository extends Repository
{
    public function getPaymentDataJSON()
    {
        try {
            $stmt = $this->connection->prepare("SELECT reservation.id, reservation.name, reservation.restaurantID, 
                                                restaurant.name AS restaurantName, reservation.sessionID, reservation.seats, reservation.date, reservation.request, 
                                                reservation.price, reservation.status 
                                                FROM reservation
                                                JOIN restaurant ON reservation.restaurantID = restaurant.id");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'reservation');
            $reservations = $stmt->fetchAll();

            return $reservations;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function getKey(string $key)
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, api_key FROM `Api_keys` WHERE api_key = :api_key ");
            $stmt->bindParam(':api_key', $key);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'api_key');
            $keys = $stmt->fetchAll();

            if (is_null($keys) || empty($keys))
                return null;

            return $keys[0];
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
