<?php
require __DIR__ . '/../models/product.php';

class ProductRepository
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

    function getOneProduct($product_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT product.id as event_id,
            COALESCE(NULLIF(artist.name,''), NULLIF(ticketpass.name,''), 'History Event') AS event_name,
            COALESCE(NULLIF(events.ticket_price,''), NULLIF(ticketpass.price,''), NULLIF(merchandise.price,''), 0) AS event_price,
            COALESCE(NULLIF(events.datetime,''), NULLIF(ticketpass.datetime,''), merchandise.datetime) AS event_datetime,
            COALESCE(NULLIF(venue.name,''), merchandise.location, 'Everywhere') AS event_location,
            COALESCE(NULLIF(events.tickets_available,''), merchandise.tickets_available, '10000') AS tickets_available,
            COALESCE(NULLIF(events.type,''), NULLIF(ticketpass.type,''), 'history') AS event_type
            FROM product as product
            LEFT JOIN music_event as events on 
            (product.id = events.product_id AND product.eventId = events.id)
            LEFT JOIN history_event as merchandise on
            (product.id=merchandise.product_id AND product.eventId = merchandise.id)
            LEFT JOIN ticketpass as ticketpass ON
            (product.id=ticketpass.product_id AND product.eventId=ticketpass.id)
            LEFT JOIN venue as venue ON venue.id = events.venue
            LEFT JOIN artist as artist ON artist.id = events.artist
            WHERE product.id=:id");
            $stmt->bindParam(':id', $product_id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            $product = $stmt->fetch();

            return $product;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
