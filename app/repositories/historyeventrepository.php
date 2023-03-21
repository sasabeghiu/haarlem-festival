<?php

require __DIR__ . '/../models/historyevent.php';

class HistoryEventRepository
{
    protected $connection;

    public function __construct()
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
            $stmt = $this->connection->prepare("SELECT history_event.id, history_event.tickets_available, history_event.price, history_event.datetime, history_event.location, images.image, history_event.tourguideID, tourguide.name AS tourguideName, tourguide.description AS tourguideDescription, history_event.product_id
                                                      FROM history_event
                                                      JOIN images ON history_event.image=images.id
                                                      JOIN tourguide ON history_event.tourguideID=tourguide.id
                                                      ORDER BY history_event.datetime");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'HistoryEvent');
            $historyevents = $stmt->fetchAll();

            return $historyevents;
        }catch (PDOException $e){
            echo $e;
        }
    }

    function getHistoryEventsByDate($datetime)
    {
        try {
            $stmt = $this->connection->prepare("SELECT history_event.id, history_event.tickets_available, history_event.price, history_event.datetime, history_event.location, images.image, history_event.tourguideID, tourguide.name AS tourguideName, tourguide.description AS tourguideDescription, history_event.product_id
                                                      FROM history_event
                                                      JOIN images ON history_event.image=images.id
                                                      JOIN tourguide ON history_event.tourguideID=tourguide.id
                                                      WHERE history_event.datetime LIKE :datetime
                                                      ORDER BY history_event.datetime");
            $stmt->bindParam(':datetime', $datetime);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'HistoryEvent');
            $historyevents = $stmt->fetchAll();

            return $historyevents;
        }catch (PDOException $e){
            echo $e;
        }
    }
}
