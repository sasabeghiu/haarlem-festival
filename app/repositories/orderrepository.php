<?php

require __DIR__ . '/repository.php';
require __DIR__ . '/../models/order.php';

class OrderRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT orders.id, orders.firstName, orders.lastName, orders.birthdate, orders.emailAddress, orders.streetAddress, orders.vat, orders.city, orders.postalCode, orders.phoneNumber
                                                        FROM orders");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
            $order = $stmt->fetchAll();

            return $order;
        } catch (PDOException $e){
            echo $e;
        }
    }
}