<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/tourGuide.php';

class TourGuideRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM tourguide");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'TourGuide');
            $tourguides = $stmt->fetchAll();

            return $tourguides;
        }catch (PDOException $e){
            echo $e;
        }
    }

    function insert($tourguides){
        try {
            $stmt = $this->connection->prepare("INSERT into tourguide (id, name, description, image) VALUES (?,?,?,?)");

            $stmt->execute([$tourguides->getId(), $tourguides->getName(), $tourguides->getDescription(), $tourguides->getImage()]);

        }catch (PDOException $e){
            echo $e;
        }
    }
}
