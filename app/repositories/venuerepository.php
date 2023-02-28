<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/venue.php';

class VenueRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT venue.id, venue.name, venue.description, venue.type, img1.image AS image, img2.image AS headerImg  
            FROM venue 
            JOIN images as img1 ON venue.image=img1.id
            JOIN images as img2 ON venue.headerImg=img2.id");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venues = $stmt->fetchAll();

            return $venues;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAllDanceVenues()
    {
        try {
            $stmt = $this->connection->prepare("SELECT venue.id, venue.name, venue.description, venue.type, img1.image AS image, img2.image AS headerImg  
            FROM venue 
            JOIN images as img1 ON venue.image=img1.id
            JOIN images as img2 ON venue.headerImg=img2.id
            WHERE venue.type='dance'");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venues = $stmt->fetchAll();

            return $venues;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAllJazzVenues()
    {
        try {
            $stmt = $this->connection->prepare("SELECT venue.id, venue.name, venue.description, venue.type, img1.image AS image, img2.image AS headerImg  
            FROM venue 
            JOIN images as img1 ON venue.image=img1.id
            JOIN images as img2 ON venue.headerImg=img2.id
            WHERE venue.type='jazz'");
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
            $stmt = $this->connection->prepare("SELECT venue.id, venue.name, venue.description, venue.type, img1.image AS image, img2.image AS headerImg  
            FROM venue 
            JOIN images as img1 ON venue.image=img1.id
            JOIN images as img2 ON venue.headerImg=img2.id 
            WHERE venue.id = :id");
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
            $stmt = $this->connection->prepare("INSERT INTO venue (name, description, type, image, headerImg) VALUES (?,?,?,?,?)");
            $stmt->execute([$venue->getName(), $venue->getDescription(), $venue->getType(), $venue->getImage(), $venue->getHeaderImg()]);
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
            $stmt = $this->connection->prepare("UPDATE venue SET name = ?, description = ?, type = ?, image = ?, headerImg = ? WHERE id = ?");
            $stmt->execute([$venue->getName(), $venue->getDescription(), $venue->getType(), $venue->getImage(), $venue->getHeaderImg(), $id]);
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
