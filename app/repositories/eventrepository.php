<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/music_event.php';

class EventRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT e.id, e.type, e.artist, v.name as venue, e.ticket_price, e.tickets_available, e.datetime, i.image, a1.name
            FROM music_event as e 
            JOIN venue as v ON e.venue=v.id
            JOIN artist as a1 ON e.name=a1.id
            JOIN images as i ON a1.thumbnailImg=i.id
            ORDER BY e.datetime");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Music_Event');
            $events = $stmt->fetchAll();

            return $events;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT e.id, e.type, e.artist, v.name as venue, e.ticket_price, e.tickets_available, e.datetime, i.image, a1.name
            FROM music_event as e 
            JOIN venue as v ON e.venue=v.id
            JOIN artist as a1 ON e.name=a1.id
            JOIN images as i ON a1.thumbnailImg=i.id
            WHERE id = :id
            ORDER BY e.datetime");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Music_Event');
            $event = $stmt->fetch();

            return $event;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getEventsByDate($datetime)
    {
        try {
            $stmt = $this->connection->prepare("SELECT e.id, e.type, e.artist, v.name as venue, e.ticket_price, e.tickets_available, e.datetime, i.image, a1.name
            FROM music_event as e 
            JOIN venue as v ON e.venue=v.id
            JOIN artist as a1 ON e.name=a1.id
            JOIN images as i ON a1.thumbnailImg=i.id
            WHERE datetime LIKE :datetime");
            $stmt->bindParam(':datetime', $datetime);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Music_Event');
            $events = $stmt->fetchAll();

            return $events;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
