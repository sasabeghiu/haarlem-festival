<?php

require __DIR__ . '/repository.php';
require __DIR__ . '/../models/orderscms.php';

class OrdersCmsRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT orders.id, orders.firstName, orders.lastName, orders.birthdate, orders.emailAddress, orders.streetAddress, orders.country, orders.zipCode, orders.phoneNumber
                                                FROM orders");

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'OrdersCms');
            $placedorder = $stmt->fetchAll();

            return $placedorder;
        } catch (PDOException $e){
            echo $e;
        }
    }

    function getOneOrder($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT orders.id, orders.firstName, orders.lastName, orders.birthdate, orders.emailAddress, orders.streetAddress, orders.country, orders.zipCode, orders.phoneNumber
                                                FROM orders
                                                WHERE orders.id = :id");
            
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'OrdersCms');
            $placedorder = $stmt->fetch();

            return $placedorder;
        } catch (PDOException $e){
            echo $e;
        }
    }

    function updatePlacedOrder($placedorder, $id)
    {
        try{
            $stmt = $this->connection->prepare("UPDATE orders SET firstName = ?, lastName = ?, birthdate = ?, emailAddress = ?, streetAddress = ?, country = ?, zipCode = ?, phoneNumber = ?
                                                WHERE id = ?");

            $stmt->execute([$placedorder->getFirstName(), $placedorder->getLastName(), $placedorder->getBirthDate(), $placedorder->getEmailAddress(), $placedorder->getStreetAddress(), $placedorder->getCountry(), $placedorder->getZipCode(), $placedorder->getPhoneNumber(), $id]);

        } catch (PDOException $e){
            echo $e;
        }
    }
}