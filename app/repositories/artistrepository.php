<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/artist.php';

class ArtistRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT artist.id, artist.name, artist.description, artist.type,  img1.image AS headerImg, img2.image AS thumbnailImg 
            FROM artist 
            JOIN images as img1
            ON artist.headerImg=img1.id 
            JOIN images as img2
            ON artist.thumbnailImg=img2.id");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');
            $artists = $stmt->fetchAll();

            return $artists;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT artist.id, artist.name, artist.description, artist.type,  img1.image AS headerImg, img2.image AS thumbnailImg 
            FROM artist 
            JOIN images as img1
            ON artist.headerImg=img1.id 
            JOIN images as img2
            ON artist.thumbnailImg=img2.id
            WHERE artist.id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');
            $artist = $stmt->fetch();

            return $artist;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    //insert
    function addArtist($artist)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO artist (name, description, type, headerImg, thumbnailImg) VALUES (?,?,?,?,?)");
            $stmt->execute([$artist->getName(), $artist->getDescription(), $artist->getType(), $artist->getHeaderImg(), $artist->getThumbnailImg()]);
            $artist->setId($this->connection->lastInsertId());

            return $this->getOne($artist->getId());
        } catch (PDOException $e) {
            echo $e;
        }
    }

    //update
    function updateArtist($artist, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE artist SET name = ?, description = ?, type = ?, headerImg = ?, thumbnailImg = ? WHERE id = ?");
            $stmt->execute([$artist->getName(), $artist->getDescription(), $artist->getType(), $artist->getHeaderImg(), $artist->getThumbnailImg(), $id]);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    //delete
    function deleteArtist($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM artist WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }
}
