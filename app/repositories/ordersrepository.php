<?php

require __DIR__ . '/../models/orders.php';
require __DIR__ . '/../models/orders_item.php';

class OrdersRepository
{

    private $connection;

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

    function getOnePlacedOrder($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT orders.id, orders.firstName, orders.lastName, orders.birthdate, orders.emailAddress, orders.streetAddress, orders.country, orders.zipCode, orders.phoneNumber, orders.totalprice
                                                FROM orders
                                                WHERE orders.id = :id");

            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Orders');
            $order_item = $stmt->fetch();

            return $order_item;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOneOrderItem($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM orders_item
                                                WHERE id = :id");

            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'OrdersItem');
            $placeorder = $stmt->fetch();

            return $placeorder;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function placeOrder(Orders $placeorder)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO orders (firstName, lastName, birthdate, emailAddress, streetAddress, country, zipCode, phoneNumber, user_id, totalprice)
                                                VALUES (:firstName, :lastName, :birthdate, :emailAddress, :streetAddress, :country, :zipCode, :phoneNumber, :user_id, :totalprice)");

            $stmt->bindValue(':firstName', $placeorder->getFirstName());
            $stmt->bindValue(':lastName', $placeorder->getLastName());
            $stmt->bindValue(':birthdate', $placeorder->getBirthDate());
            $stmt->bindValue(':emailAddress', $placeorder->getEmailAddress());
            $stmt->bindValue(':streetAddress', $placeorder->getStreetAddress());
            $stmt->bindValue(':country', $placeorder->getCountry());
            $stmt->bindValue(':zipCode', $placeorder->getZipCode());
            $stmt->bindValue(':phoneNumber', $placeorder->getPhoneNumber());
            $stmt->bindValue(':user_id', $placeorder->getUserId());
            $stmt->bindValue(':totalprice', $placeorder->getTotalPrice());

            $stmt->execute();

            $placeorder->setId($this->connection->lastInsertId());

            return $this->getOnePlacedOrder($placeorder->getId());
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAllOrders()
    {
        try {
            $stmt = $this->connection->prepare("SELECT orders.id, orders.firstName, orders.lastName, orders.birthdate, orders.emailAddress, orders.streetAddress, orders.country, orders.zipCode, orders.phoneNumber, orders.user_id, orders.totalprice
                                                FROM orders");

            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Orders');
            $placedorder = $stmt->fetchAll();

            return $placedorder;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOrderItemsByOrderId($orderId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM orders_item
            WHERE order_id = :orderId");

            $stmt->bindParam(':orderId', $orderId);

            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'OrdersItem');
            $orderItems = $stmt->fetchAll();

            return $orderItems;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getById($id) //returns order(s) object matching given id
    {
        $stmt = $this->connection->prepare('SELECT * FROM orders WHERE id = :id');

        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        $order = new Orders();
        $order->setId($row['id']);
        $order->setFirstName($row['firstName']);
        $order->setLastName($row['lastName']);
        $order->setBirthDate($row['birthdate']);
        $order->setEmailAddress($row['emailAddress']);
        $order->setStreetAddress($row['streetAddress']);
        $order->setCountry($row['country']);
        $order->setZipCode($row['zipCode']);
        $order->setPhoneNumber($row['phoneNumber']);
        $order->setUserId($row['user_id']);
        $order->setTotalPrice($row['totalprice']);
        $order->setPaymentId($row['paymentId']);

        return $order;
    }

    public function addPayment($id, $paymentId) //returns order(s) object matching given id
    {
        $stmt = $this->connection->prepare('UPDATE orders
        SET paymentId = :paymentId
        WHERE id = :id');

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':paymentId', $paymentId);
        return $stmt->execute();
    }


    function updatePlacedOrder($placedorder, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE orders SET firstName = ?, lastName = ?, birthdate = ?, emailAddress = ?, streetAddress = ?, country = ?, zipCode = ?, phoneNumber = ?
                                                WHERE id = ?");

            $stmt->execute([$placedorder->getFirstName(), $placedorder->getLastName(), $placedorder->getBirthDate(), $placedorder->getEmailAddress(), $placedorder->getStreetAddress(), $placedorder->getCountry(), $placedorder->getZipCode(), $placedorder->getPhoneNumber(), $id]);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function placeOneOrderItem($orderItem)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO orders_item (order_id, product_id, qty, price) 
                                                VALUES (?,?,?,?)");

            $stmt->execute([$orderItem->getOrder_id(), $orderItem->getProduct_id(), $orderItem->getQty(), $orderItem->getPrice()]);

            $orderItem->setId($this->connection->lastInsertId());

            return $this->getOneOrderItem($orderItem->getId());
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function cancelOrder($userId) //deletes last order by userId
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM orders
            WHERE user_id = :userId
            AND created_at = (
              SELECT MAX(created_at)
              FROM orders
              WHERE user_id = :userId
            )");

            $stmt->bindParam(':userId', $userId);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getTicketInfo($productId) //
    {
        try {
            $stmt = $this->connection->prepare("SELECT 
            COALESCE(reservation.restaurantId, ticketpass.name, history_event.location, 
                music_event.type) AS event_column_1, 
            COALESCE(reservation.seats, ticketpass.type, history_event.tourguideID, 
                CONCAT(music_event.artist, ' @ ', music_event.venue)) AS event_column_2
        FROM (
            SELECT id FROM reservation WHERE id = :productId
            UNION SELECT id FROM ticketpass WHERE id = :productId
            UNION SELECT id FROM history_event WHERE id = :productId
            UNION SELECT id FROM music_event WHERE id = :productId
        ) AS events
        LEFT JOIN reservation ON reservation.id = events.id 
        LEFT JOIN ticketpass ON ticketpass.id = events.id 
        LEFT JOIN history_event ON history_event.id = events.id 
        LEFT JOIN music_event ON music_event.id = events.id;
        ");

            $stmt->bindParam(':productId', $productId);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
