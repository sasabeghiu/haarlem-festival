<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/venue.php';

class VenueRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT venue.id, venue.name, venue.description, venue.type, images.image FROM venue JOIN images ON venue.image=images.id");
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
            $stmt = $this->connection->prepare("SELECT venue.id, venue.name, venue.description, venue.type, images.image FROM venue JOIN images ON venue.image=images.id WHERE venue.id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venue = $stmt->fetch();

            return $venue;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    //insert
    function addVenue($venue)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO venue (name, description, type, image) VALUES (?,?,?,?)");
            $stmt->execute([$venue->getName(), $venue->getDescription(), $venue->getType(), $venue->getImage()]);
            $venue->setId($this->connection->lastInsertId());

            return $this->getOne($venue->getId());
        } catch (PDOException $e) {
            echo $e;
        }
    }

    //update
    function updateVenue($venue, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE venue SET name = ?, description = ?, type = ?, image = ? WHERE id = ?");
            $stmt->execute([$venue->getName(), $venue->getDescription(), $venue->getType(), $venue->getImage(), $id]);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    //delete
    function deleteVenue($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM venue WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }
}
