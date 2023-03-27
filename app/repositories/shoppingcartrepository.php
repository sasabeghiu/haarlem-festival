<?php
require __DIR__ . '/../models/shoppingcartitem.php';
require __DIR__ . '/../models/orders.php';

class ShoppingCartRepository
{
    protected $connection;

    function __construct()
    {
        require __DIR__ . '/../config/dbconfig.php';

        try {
            $this->connection = new PDO("$type:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function checkIfProductExistsInCart($user_id, $product_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT count(*) FROM shopping_cart_items WHERE user_id=:user_id AND product_id=:product_id");

            $user_id = htmlspecialchars(strip_tags($user_id));
            $product_id = htmlspecialchars(strip_tags($product_id));

            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":product_id", $product_id);

            $stmt->execute();

            $rows = $stmt->fetch(PDO::FETCH_NUM);

            if ($rows[0] > 0) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function addProductToCart(ShoppingCartItem $shoppingCartItem)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO shopping_cart_items(user_id, product_id, qty) VALUES (:user_id, :product_id, :qty)");

            $stmt->bindValue(":user_id", $shoppingCartItem->getUser_id());
            $stmt->bindValue(":product_id", $shoppingCartItem->getProduct_id());
            $stmt->bindValue(":qty", $shoppingCartItem->getQty());

            if ($stmt->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function updateProductQty($product_id, $user_id, $qty)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE shopping_cart_items SET qty=:qty WHERE product_id=:product_id AND user_id=:user_id");

            $product_id = htmlspecialchars(strip_tags($product_id));
            $user_id = htmlspecialchars(strip_tags($user_id));
            $qty = htmlspecialchars(strip_tags($qty));

            $stmt->bindParam(":product_id", $product_id);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":qty", $qty);

            if ($stmt->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function removeProductFromCart($product_id, $user_id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM shopping_cart_items WHERE user_id=:user_id AND product_id=:product_id");

            $product_id = htmlspecialchars(strip_tags($product_id));
            $user_id = htmlspecialchars(strip_tags($user_id));

            $stmt->bindParam(":product_id", $product_id);
            $stmt->bindParam(":user_id", $user_id);

            if ($stmt->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getShoppingCartByUserId($user_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT p.id,
            COALESCE(NULLIF(artist.name,''), NULLIF(ticketpass.name,''), 'History Event') AS event_name,
			COALESCE(NULLIF(events.ticket_price,''), NULLIF(ticketpass.price,''), NULLIF(merchandise.price,''), 0) AS event_price,
			ci.qty, ci.qty * COALESCE(NULLIF(events.ticket_price,''), NULLIF(ticketpass.price,''), NULLIF(merchandise.price,''), 0) AS subtotal
            FROM shopping_cart_items ci 
            LEFT JOIN product p
            ON ci.product_id=p.id
            LEFT JOIN music_event as events on 
            (p.id = events.product_id AND p.eventId = events.id)
            LEFT JOIN history_event as merchandise on
            (p.id=merchandise.product_id AND p.eventId = merchandise.id)
            LEFT JOIN ticketpass as ticketpass ON
            (p.id=ticketpass.product_id AND p.eventId=ticketpass.id)
            LEFT JOIN venue as venue ON venue.id = events.venue
            LEFT JOIN artist as artist ON artist.id = events.artist
            WHERE ci.user_id=:user_id");

            $user_id = htmlspecialchars(strip_tags($user_id));

            $stmt->bindParam(":user_id", $user_id);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'ShoppingCartItem');
            $item = $stmt->fetchAll();

            return $item;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function countProducts($user_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT count(*) FROM shopping_cart_items WHERE user_id=:user_id");

            $user_id = htmlspecialchars(strip_tags($user_id));

            $stmt->bindParam(":user_id", $user_id);

            $stmt->execute();

            $rows = $stmt->fetch(PDO::FETCH_NUM);

            return $rows[0];
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function placeOneOrder($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT orders.id, orders.firstName, orders.lastName, orders.birthdate, orders.emailAddress, orders.streetAddress, orders.country, orders.zipCode, orders.phoneNumber
                                                FROM orders
                                                WHERE orders.id = :id");
            
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Orders');
            $placeorder = $stmt->fetch();

            return $placeorder;
        } catch (PDOException $e){
            echo $e;
        }
    }

    function placeOrder(Orders $placeorder)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO orders (firstName, lastName, birthdate, emailAddress, streetAddress, country, zipCode, phoneNumber)
                                                VALUES (:firstName, :lastName, :birthdate, :emailAddress, :streetAddress, :country, :zipCode, :phoneNumber)");

            $stmt->bindValue(':firstName', $placeorder->getFirstName());
            $stmt->bindValue(':lastName', $placeorder->getLastName());
            $stmt->bindValue(':birthdate', $placeorder->getBirthDate());
            $stmt->bindValue(':emailAddress', $placeorder->getEmailAddress());
            $stmt->bindValue(':streetAddress', $placeorder->getStreetAddress());
            $stmt->bindValue(':country', $placeorder->getCountry());
            $stmt->bindValue(':zipCode', $placeorder->getZipCode());
            $stmt->bindValue(':phoneNumber', $placeorder->getPhoneNumber());

            $stmt->execute();

            $placeorder->setId($this->connection->lastInsertId());

            return $this->placeOneOrder($placeorder->getId());
        } catch (PDOException $e){
            echo $e;
        }
    }
}
