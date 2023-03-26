<?php
require __DIR__ . '/repository.php';

class KeysRepository extends Repository {
    
    public function addKey($jwt) {
        $stmt = $this->connection->prepare("INSERT INTO `Api_Keys (token) VALUES (:token) ");
        $stmt->bindValue(':token', $jwt);

        $stmt->execute();
    }
}