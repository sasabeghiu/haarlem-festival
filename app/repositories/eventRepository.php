<?php

require __DIR__ . '/repository.php';
require __DIR__ . '/../models/event.php';

class EventRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM history_event");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS,'Event');
            $events = $stmt->fetchAll();

            return $events;
        }catch (PDOException $e){
            echo $e;
        }
    }

    function insert($events){
        try {
            $stmt = $this->connection->prepare("INSERT into history_event (id, tickets_available, price, datetime, venueID, image) VALUES (?,?,?,?,?,?)");

            $stmt->execute([$events->getId(), $events->getTicketsAvailable(), $events->getPrice(), $events->getDateTime(), $events->getVenueId(), $events->getImage()]);

        }catch (PDOException $e){
            echo $e;
        }
    }
}