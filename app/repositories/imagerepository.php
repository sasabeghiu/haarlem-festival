<?php
require __DIR__ . '/../models/image.php';

class ImageRepository
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

    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, image FROM images WHERE id=:id");
            $stmt->bindParam(':id', $id);

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Image');
            $image = $stmt->fetch();

            return $image;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function addImage($image)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO images (image) VALUES (?)");
            $stmt->execute([$image->getImage()]);
            $image->setId($this->connection->lastInsertId());

            return $this->getOne($image->getId());
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
