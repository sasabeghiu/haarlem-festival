<?php

require __DIR__ . '/repository.php';
require __DIR__ . '/../models/tourGuideCms.php';

class TourGuideCmsRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT tourguide.id, tourguide.name, tourguide.description, images.image
                                                      FROM tourguide
                                                      JOIN images ON tourguide.image=images.id");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'TourGuideCms');
            $tourguidescms = $stmt->fetchAll();

            return $tourguidescms;
        } catch (PDOException $e){
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT tourguide.id, tourguide.name, tourguide.description, images.image
                                                      FROM tourguide
                                                      JOIN images ON tourguide.image=images.id
                                                      WHERE tourguide.id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'TourGuideCms');
            $tourguidescms = $stmt->fetch();

            return $tourguidescms;
        } catch (PDOException $e){
            echo $e;
        }
    }

    function getOneTourguideByName($name)
    {
        try {
            $stmt = $this->connection->prepare("SELECT tourguide.id, tourguide.name, tourguide.description, images.image
                                                      FROM tourguide
                                                      JOIN images ON tourguide.image=images.id
                                                      WHERE tourguide.name = :name");
            $stmt->bindParam(':name', $name);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'TourGuideCms');
            $tourguidescms = $stmt->fetch();

            return $tourguidescms;
        } catch (PDOException $e){
            echo $e;
        }
    }

    //Adding Tour Guides by using the CMS
    function addTourguide($tourguides)
    {
        try {
            $stmt = $this->connection->prepare("INSERT into tourguide (id, name, description, image) VALUES (?,?,?,?)");

            $stmt->execute([$tourguides->getId(), $tourguides->getName(), $tourguides->getDescription(), $tourguides->getImage()]);

            $tourguides->setId($this->connection->lastInsertId());

            return $this->getOne($tourguides->getId());
        }catch (PDOException $e){
            echo $e;
        }
    }

    //Updating the Tour Guides by using the CMS
    function updateTourguide($tourguides, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE tourguide SET name = ?, description = ?, image = ? WHERE id = ?");
            $stmt->execute([$tourguides->getName(), $tourguides->getDescription(), $tourguides->getImage(), $id]);
        } catch (PDOException $e){
            echo $e;
        }
    }

    //Deleting the Tour Guides by using CMS
    function deleteTourguide($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM tourguide WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return;
        } catch (PDOException $e){
            echo $e;
        }
        return true;
    }
}