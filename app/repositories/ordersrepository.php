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
            $stmt = $this->connection->prepare("SELECT orders.id, orders.firstName, orders.lastName, orders.birthdate, orders.emailAddress, orders.streetAddress, orders.country, orders.zipCode, orders.phoneNumber, orders.user_id, orders.totalprice, orders.paymentId
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

    function deleteLastInsertedOrder()
    {
        try {
            // Get the last inserted ID
            $stmt = $this->connection->query("SELECT id FROM orders ORDER BY id DESC LIMIT 1");
            $lastInsertedId = $stmt->fetchColumn();

            // Delete the order with the last inserted ID
            $stmt = $this->connection->prepare("DELETE FROM orders WHERE id = :id");
            $stmt->bindParam(':id', $lastInsertedId);
            $stmt->execute();
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
            $stmt = $this->connection->prepare("SELECT orders.id, orders.firstName, orders.lastName, orders.birthdate, orders.emailAddress, orders.streetAddress, orders.country, orders.zipCode, orders.phoneNumber, orders.user_id, orders.totalprice, orders.paymentId
                                                FROM orders");

            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Orders');
            $placedorder = $stmt->fetchAll();

            return $placedorder;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function getPaidOrders()
    {
        try {
            $stmt = $this->connection->prepare("SELECT orders.id, orders.firstName, orders.lastName, orders.birthdate, orders.emailAddress, orders.streetAddress, orders.country, orders.zipCode, orders.phoneNumber, orders.user_id, orders.totalprice, orders.paymentId
                                                FROM orders
                                                WHERE orders.paymentId IS NOT NULL");

            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Orders');
            $paidorders = $stmt->fetchAll();

            if (!$paidorders || empty($paidorders))
                return null;

            return $paidorders;
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
            $stmt = $this->connection->prepare("UPDATE orders SET firstName = ?, lastName = ?, birthdate = ?, emailAddress = ?, streetAddress = ?, country = ?, zipCode = ?, phoneNumber = ?, user_id = ?, totalprice = ?, paymentId = ?
                                                WHERE id = ?");

            $stmt->execute([$placedorder->getFirstName(), $placedorder->getLastName(), $placedorder->getBirthDate(), $placedorder->getEmailAddress(), $placedorder->getStreetAddress(), $placedorder->getCountry(), $placedorder->getZipCode(), $placedorder->getPhoneNumber(), $placedorder->getUserId(), $placedorder->getTotalPrice(), $placedorder->getPaymentId(), $id]);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function placeOneOrderItem($orderItem)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO orders_item (order_id, product_id, qty, price, user_id) 
                                                VALUES (?,?,?,?,?)");

            $stmt->execute([$orderItem->getOrder_id(), $orderItem->getProduct_id(), $orderItem->getQty(), $orderItem->getPrice(), $orderItem->getUser_id()]);

            $orderItem->setId($this->connection->lastInsertId());

            return $this->getOneOrderItem($orderItem->getId());
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function updateTicketsAvailable($product_id, $qty)
    {
        $updated = false;
        try {
            $stmt = $this->connection->prepare("UPDATE music_event
                                            SET tickets_available = tickets_available - :qty
                                            WHERE id = :product_id AND tickets_available >= :qty");

            $stmt->bindParam(":product_id", $product_id);
            $stmt->bindParam(":qty", $qty, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $updated = true;
            }

            $stmt = $this->connection->prepare("UPDATE history_event
                                            SET tickets_available = tickets_available - :qty
                                            WHERE id = :product_id AND tickets_available >= :qty");

            $stmt->bindParam(":product_id", $product_id);
            $stmt->bindParam(":qty", $qty, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $updated = true;
            }

            $stmt = $this->connection->prepare("UPDATE reservation
                                            SET seats = seats - :qty
                                            WHERE id = :product_id AND seats >= :qty");

            $stmt->bindParam(":product_id", $product_id);
            $stmt->bindParam(":qty", $qty, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $updated = true;
            }

            return $updated;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getMyOrdersByUserId($user_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT subq.event_id as id,
                COALESCE(NULLIF(subq.event_name,''), 'History Event') AS event_name,
                COALESCE(NULLIF(subq.event_price,''), 0) AS event_price,
                ci.qty
                FROM orders_item ci
                LEFT JOIN (
                    SELECT music_event.id as event_id, artist.name as event_name, music_event.ticket_price as event_price, music_event.datetime as event_datetime, venue.name as event_location, music_event.tickets_available as stock, music_event.type as event_type
                    FROM music_event 
                    LEFT JOIN venue as venue ON venue.id = music_event.venue
                    LEFT JOIN artist as artist ON artist.id = music_event.artist
                    UNION
                    SELECT id as event_id, ticketpass.name as event_name, ticketpass.price as event_price, ticketpass.datetime as event_datetime, 'Haarlem' as event_location, 'no limit' as stock, ticketpass.type as event_type
                    FROM ticketpass 
                    UNION
                    SELECT id as event_id, 'History Event' as event_name, history_event.price as event_price, history_event.datetime as event_datetime, history_event.location as event_location, history_event.tickets_available as stock, 'history' as event_type
                    FROM history_event 
                    UNION
                    SELECT reservation.id as event_id, CONCAT('Reservation at ', restaurant.name) as event_name, reservation.price as event_price, reservation.date as event_datetime, restaurant.name as event_location, reservation.seats as stock, 'food' as event_type
                    FROM reservation 
                    LEFT JOIN restaurant as restaurant on restaurant.id = reservation.restaurantID
                ) AS subq ON subq.event_id = ci.product_id
                WHERE ci.user_id = :user_id");

            $user_id = htmlspecialchars(strip_tags($user_id));

            $stmt->bindParam(":user_id", $user_id);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'OrdersItem');
            $items = $stmt->fetchAll();

            return $items;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function countMyOrders($product_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT count(*) FROM orders_item WHERE product_id=:product_id");

            $product_id = htmlspecialchars(strip_tags($product_id));

            $stmt->bindParam(":product_id", $product_id);

            $stmt->execute();

            $rows = $stmt->fetch(PDO::FETCH_NUM);

            return $rows[0];
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
