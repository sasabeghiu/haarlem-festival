<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/restaurant.php';
require __DIR__ . '/../models/session.php';

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

            return $restaurants[0];
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function getSessions()
    {
        try {
            $stmt = $this->connection->prepare("SELECT fs.id, fs.restaurantid, restaurant.name AS restaurantname, fs.sessions, fs.price, fs.reducedprice, fs.first_session,
                                                fs.session_length, fs.seats FROM `food_session` AS fs 
                                                JOIN restaurant ON fs.restaurantid = restaurant.id");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'session');
            $sessions = $stmt->fetchAll();

            return $sessions;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function getSessionById()
    {
        $id = htmlspecialchars($_GET["sessionid"]);

        try {
            $stmt = $this->connection->prepare("SELECT fs.id, fs.restaurantid, restaurant.name AS restaurantname, fs.sessions, fs.price, fs.reducedprice, fs.first_session,
                                                fs.session_length, fs.seats FROM `food_session` AS fs 
                                                JOIN restaurant ON fs.restaurantid = restaurant.id
                                                WHERE fs.id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'session');
            $sessions = $stmt->fetchAll();

            return $sessions[0];
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function saveSession(Session $session)
    {
        try {
            if ($session->getId() != 0) {
                // Update existing session
                $stmt = $this->connection->prepare("UPDATE `food_session` SET sessions = :sessions, price = :price, reducedprice = :reducedprice, 
                                                    first_session = :first_session, session_length = :session_length, seats = :seats 
                                                    WHERE id = :id");
                $stmt->bindValue(':id', $session->getId());
            } else {
                // Insert new session
                $stmt = $this->connection->prepare("INSERT INTO `food_session` (restaurantid, sessions, price, reducedprice, 
                                                    first_session, session_length, seats) VALUES (:restaurantid, :sessions, :price, 
                                                    :reducedprice, :first_session, :session_length, :seats)");
            }

            $stmt->bindValue(':restaurantid', $session->getRestaurantid());
            $stmt->bindValue(':sessions', $session->getSessions());
            $stmt->bindValue(':price', $session->getPrice());
            $stmt->bindValue(':reducedprice', $session->getReducedprice());
            $stmt->bindValue(':first_session', $session->getFirst_session());
            $stmt->bindValue(':session_length', $session->getSession_length());
            $stmt->bindValue(':seats', $session->getSeats());

            $stmt->execute();
        } catch (PDOException $e) {
            echo ($e);
        }
        // if ($stmt) {
        //     return true;
        // }
    }
    public function deleteSession() {
        $sessionid = htmlspecialchars($_GET['sessionid']);

        try{
            $stmt = $this->connection->prepare("DELETE FROM `food_session` WHERE id = :id");

            $stmt->bindParam(':id', $sessionid);
            $stmt->execute();
        }
        catch(PDOException $e){
            echo ($e);
        }
    }
    public function saveRestaurant(Restaurant $restaurant)
    {
        try {
            if ($restaurant->getId() != 0) {
                // Update existing restaurant
                $stmt = $this->connection->prepare("UPDATE `restaurant` SET name = :name, location = :location, description = :description, cuisine = :cuisine, 
                                                    stars = :stars, email = :email, phonenumber = :phonenumber 
                                                    WHERE id = :id");
                $stmt->bindValue(':id', $restaurant->getId());
            } else {
                //Get the next auto increment value for the images table to assign the correct image id's to the restaurant
                $tempstmt = $this->connection->prepare("SELECT AUTO_INCREMENT
                                                        FROM information_schema.TABLES
                                                        WHERE TABLE_SCHEMA = 'haarlemfestival' 
                                                        AND TABLE_NAME = 'images'");
                $tempstmt->execute();
                $id = $tempstmt->fetchAll();
                // Insert new restaurant
                $stmt = $this->connection->prepare("INSERT INTO `restaurant` (name, location, description, cuisine, 
                                                    stars, email, phonenumber, image1, image2, image3) VALUES (:name, :location, :description, :cuisine, 
                                                    :stars, :email, :phonenumber, :image1, :image2, :image3)");
                                                    
            $stmt->bindValue(':image1', $id[0]);
            $stmt->bindValue(':image2', ($id[0] + 1));
            $stmt->bindValue(':image3', ($id[0] + 2));
            }

            $stmt->bindValue(':name', $restaurant->getName());
            $stmt->bindValue(':location', $restaurant->getLocation());
            $stmt->bindValue(':description', $restaurant->getDescription());
            $stmt->bindValue(':cuisine', $restaurant->getCuisine());
            $stmt->bindValue(':stars', $restaurant->getStars());
            $stmt->bindValue(':email', $restaurant->getEmail());
            $stmt->bindValue(':phonenumber', $restaurant->getPhonenumber());

            $stmt->execute();
        } catch (PDOException $e) {
            echo ($e);
        }
    }
    public function saveImages(string $imgData, int $id, Restaurant $restaurant) {
        try{
            if ($restaurant->getId() != 0) {
                // Update existing restaurant
                $stmt = $this->connection->prepare("UPDATE `images` SET image = :image  
                                                    WHERE id = :id");
                $stmt->bindValue(':id', $id);
            } else {
                // Insert new restaurant
                $stmt = $this->connection->prepare("INSERT INTO `images` (image) VALUES (:image)");
            }

            $stmt->bindParam('image', $imgData);
            $stmt->execute();
        } catch (Exception $e){
            echo $e;
        }

    }
}
