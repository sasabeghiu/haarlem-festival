<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/restaurant.php';

class FoodRepository extends Repository
{

    function getRestaurants()
    {
        try {
            $stmt = $this->connection->prepare("SELECT restaurant.id, restaurant.name, restaurant.location, restaurant.description, 
            restaurant.cuisine, restaurant.stars, restaurant.email, restaurant.phonenumber, img1.image AS image1, img2.image 
            AS image2, img3.image AS image3 
            FROM restaurant 
            JOIN images img1 ON img1.id = restaurant.image1 
            JOIN images img2 ON img2.id = restaurant.image2 
            JOIN images img3 ON img3.id = restaurant.image3");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'restaurant');
            $restaurants = $stmt->fetchAll();

            return $restaurants;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getRestaurantById()
    {
        $id = htmlspecialchars($_GET["restaurantid"]);

        try {
            //images.image is joined multiple times under different aliases to select the multiple images needed for each restaurant
            $stmt = $this->connection->prepare("SELECT restaurant.id, restaurant.name, restaurant.location, restaurant.description, 
            restaurant.cuisine, restaurant.stars, restaurant.email, restaurant.phonenumber, img1.image AS image1, img2.image 
            AS image2, img3.image AS image3 
            FROM restaurant 
            JOIN images img1 ON img1.id = restaurant.image1 
            JOIN images img2 ON img2.id = restaurant.image2 
            JOIN images img3 ON img3.id = restaurant.image3 
            WHERE restaurant.id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'restaurant');
            $restaurants = $stmt->fetchAll();

            return $restaurants;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
