<?php
require __DIR__ . '/../models/music_event.php';

class EventRepository
{
    protected $connection;

    function __construct()
    {
        require __DIR__ . '/../config/dbconfig.php';

        try {
            $this->connection = new PDO("$type:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

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

    function getAllDanceEvents()
    {
        try {
            $stmt = $this->connection->prepare("SELECT e.id, e.type, e.artist, v.name as venue, e.ticket_price, e.tickets_available, e.datetime, i.image, a1.name
            FROM music_event as e 
            JOIN venue as v ON e.venue=v.id
            JOIN artist as a1 ON e.name=a1.id
            JOIN images as i ON a1.thumbnailImg=i.id
            WHERE e.type='dance'
            ORDER BY e.datetime");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Music_Event');
            $events = $stmt->fetchAll();

            return $events;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAllJazzEvents()
    {
        try {
            $stmt = $this->connection->prepare("SELECT e.id, e.type, e.artist, v.name as venue, e.ticket_price, e.tickets_available, e.datetime, i.image, a1.name
            FROM music_event as e 
            JOIN venue as v ON e.venue=v.id
            JOIN artist as a1 ON e.name=a1.id
            JOIN images as i ON a1.thumbnailImg=i.id
            WHERE e.type='jazz'
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

    function getDanceEventsByDate($datetime)
    {
        try {
            $stmt = $this->connection->prepare("SELECT e.id, e.type, e.artist, v.name as venue, e.ticket_price, e.tickets_available, e.datetime, i.image, a1.name
            FROM music_event as e 
            JOIN venue as v ON e.venue=v.id
            JOIN artist as a1 ON e.name=a1.id
            JOIN images as i ON a1.thumbnailImg=i.id
            WHERE e.type='dance' AND datetime LIKE :datetime");
            $stmt->bindParam(':datetime', $datetime);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Music_Event');
            $events = $stmt->fetchAll();

            return $events;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getJazzEventsByDate($datetime)
    {
        try {
            $stmt = $this->connection->prepare("SELECT e.id, e.type, e.artist, v.name as venue, e.ticket_price, e.tickets_available, e.datetime, i.image, a1.name
            FROM music_event as e 
            JOIN venue as v ON e.venue=v.id
            JOIN artist as a1 ON e.name=a1.id
            JOIN images as i ON a1.thumbnailImg=i.id
            WHERE e.type='jazz' AND datetime LIKE :datetime");
            $stmt->bindParam(':datetime', $datetime);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Music_Event');
            $events = $stmt->fetchAll();

            return $events;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getEventsByArtistName($artistName)
    {
        try {
            $stmt = $this->connection->prepare("SELECT e.id, e.type, a1.name as artist, v.name as venue, e.ticket_price, e.tickets_available, e.datetime, i.image, a1.name
            FROM music_event as e 
            JOIN venue as v ON e.venue=v.id
            JOIN artist as a1 ON e.name=a1.id
            JOIN images as i ON a1.thumbnailImg=i.id
            WHERE a1.name LIKE :artistName");
            $stmt->bindParam(':artistName', $artistName);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Music_Event');
            $events = $stmt->fetchAll();

            return $events;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getEventsByVenueID($venueID)
    {
        try {
            $stmt = $this->connection->prepare("SELECT e.id, e.type, e.artist, e.venue, e.ticket_price, e.tickets_available, e.datetime, i.image, a1.name
            FROM music_event as e 
            JOIN artist as a1 ON e.name=a1.id
            JOIN images as i ON a1.thumbnailImg=i.id
            WHERE e.venue = :venueID");
            $stmt->bindParam(':venueID', $venueID);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Music_Event');
            $events = $stmt->fetchAll();

            return $events;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
