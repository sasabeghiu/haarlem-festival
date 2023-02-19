<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';
class UserRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $users = $stmt->fetchAll();

            return $users;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getById($id)
    {
        $query = 'SELECT * FROM user WHERE id = :id';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        $user = new User();
        $user->setId($row['id']);
        $user->setUsername($row['username']);
        $user->setPassword($row['password']);
        $user->setEmail($row['role']);
        $user->setRole($row['email']);

        return $user;
    }

    public function save(User $user)
    {
        if ($user->getId()) {
            // Update existing user
            $query = 'UPDATE users SET username = :username, password = :password, role = :role, email = :email WHERE id = :id';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':username', $user->getUsername());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':role', $user->getRole());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':id', $user->getId());
            $stmt->execute();
        } else {
            // Insert new user
            $query = 'INSERT INTO user (username, password, role, email) VALUES (:username, :password, :role, :email)';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':username', $user->getUsername());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':role', $user->getRole());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->execute();
        }
    }

    public function deleteById($id)
    {
        $query = 'DELETE FROM user WHERE id = :id';

        try {
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            if ($stmt) {
                return true;
            }
        } catch (PDOException $e) {
            echo ($e);
        }
    }
}
