<?php

require __DIR__ . '/repository.php';
require __DIR__ . '/../models/historyevent.php';

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

    function getOneHistoryEventByName($name)
    {
        try {
            $stmt = $this->connection->prepare("SELECT history_event.id, history_event.tickets_available, history_event.price, history_event.datetime, history_event.location, history_event.venueID, images.image, history_event.tourguideID, tourguide.name AS tourguideName, tourguide.description AS tourguideDescription
                                                        FROM history_event
                                                        JOIN images ON history_event.image=images.id
                                                        JOIN tourguide ON history_event.tourguideID=tourguide.id
                                                        WHERE history_event.id = :id");

        } catch (PDOException $e){
            echo $e;
        }
    }
}