<?php

require __DIR__ . '/repository.php';
require __DIR__ . '/../models/historyeventcms.php';

class HistoryEventCmsRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT history_event.id, history_event.tickets_available, history_event.price, history_event.datetime, history_event.location, history_event.venueID, images.image, history_event.tourguideID, tourguide.name AS tourguideName, tourguide.description AS tourguideDescription
                                                        FROM history_event
                                                        JOIN images ON history_event.image=images.id
                                                        JOIN tourguide ON history_event.tourguideID=tourguide.id");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'HistoryEventCms');
            $historyeventcms = $stmt->fetchAll();

            return $historyeventcms;
        } catch (PDOException $e){
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT history_event.id, history_event.tickets_available, history_event.price, history_event.datetime, history_event.location, history_event.venueID, images.image, history_event.tourguideID, tourguide.name AS tourguideName, tourguide.description AS tourguideDescription
                                                        FROM history_event
                                                        JOIN images ON history_event.image=images.id
                                                        JOIN tourguide ON history_event.tourguideID=tourguide.id
                                                        WHERE history_event.id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'HistoryEventCms');
            $historyeventcms = $stmt->fetch();

            return $historyeventcms;
        } catch (PDOException $e){
            echo $e;
        }
    }

    function addHistoryEvent(HistoryEvent $historyevent)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO history_event (tickets_available, price, datetime, location, venueID, image, tourguideID) VALUES (:tickets_available, :price, :datetime, :location, :venueID, :image, tourguideID)");

            $stmt->bindValue(':tickets_available', $historyevent->getTicketsAvailable());
            $stmt->bindValue(':price', $historyevent->getPrice());
            $stmt->bindValue(':datetime', $historyevent->getDateTime());
            $stmt->bindValue(':location', $historyevent->getLocation());
            $stmt->bindValue(':venueID', $historyevent->getVenueID());
            $stmt->bindValue(':image', $historyevent->getImage());
            $stmt->bindValue(':tourguideID', $historyevent->getTourguideID());

            $stmt->execute();

            $historyevent->setId($this->connection->lastInsertId());

            return $this->getOne($historyevent->getId());
        } catch (PDOException $e){
            echo $e;
        }
    }

    function updateHistoryEvent($historyevent, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE history_event SET tickets_available = ?, price = ?, datetime = ?, location = ?, venueID = ?, image = ?, tourguideID = ? WHERE id = ?");

            $stmt->execute([$historyevent->getTicketsAvailable(), $historyevent->getPrice(), $historyevent->getDateTime(), $historyevent->getLocation(), $historyevent->getVenueID(), $historyevent->getImage(), $historyevent->getTourguideID(), $id]);
            
        } catch (PDOException $e){
            echo $e;
        }
    }

    function deleteHistoryEvent($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE h, img
                                                FROM history_event AS h, images AS img
                                                WHERE h.id=:id AND img.id=h.image");

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }

    function saveImage(string $imgInfo)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO images (image) VALUES (:image)');

            $stmt->bindParam(':image', $imgInfo);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function updateImage($imgInfo, $id)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE images SET image = :image WHERE id = :id');
            
            $stmt->bindValue(':image', $imgInfo);

            $stmt->bindValue(':id', $id);

            $stmt->execute();

            return $id;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAHistoryEvent($id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM history_event WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'HistoryEventCms');
            $historyeventcms = $stmt->fetch();

            return $historyeventcms;
        } catch (PDOException $e){
            echo $e;
        }
    }
}