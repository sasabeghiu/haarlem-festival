<?php

require __DIR__ . '/repository.php';
require __DIR__ . '/../models/historyevent.php';

class HistoryEventRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT history_event.id, history_event.tickets_available, history_event.price, history_event.datetime, history_event.location, history_event.venueID, images.image, history_event.tourguideID, tourguide.name AS tourguideName, tourguide.description AS tourguideDescription
                                                      FROM history_event
                                                      JOIN images ON history_event.image=images.id
                                                      JOIN tourguide ON history_event.tourguideID=tourguide.id");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS,'HistoryEvent');
            $historyevents = $stmt->fetchAll();

            return $historyevents;
        }catch (PDOException $e){
            echo $e;
        }
    }

    function insert($historyevents){
        try {
            $stmt = $this->connection->prepare("INSERT into history_event (id, tickets_available, price, datetime, location, venueID, image, tourguideID) VALUES (?,?,?,?,?,?,?,?)");

            $stmt->execute([$historyevents->getId(), $historyevents->getTicketsAvailable(), $historyevents->getPrice(), $historyevents->getFormattedDate(), $historyevents->getLocation(), $historyevents->getVenueID(), $historyevents->getImage(), $historyevents->getTourguideID()]);

        }catch (PDOException $e){
            echo $e;
        }
    }
}