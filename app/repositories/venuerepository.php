<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/venue.php';

class VenueRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM venue");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venues = $stmt->fetchAll();

            return $venues;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM venue WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venue = $stmt->fetch();

            return $venue;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    //crud
}
