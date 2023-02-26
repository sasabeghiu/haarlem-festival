<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';
class LoginRepository extends Repository
{
    public function login($username, $password)
    {
        //
    }

    public function register($username, $password, $email)
    {
        try {
            // Insert new user
            $query = 'INSERT INTO user (username, password, roleId, email) VALUES (:username, :password, :roleId, :email)';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':roleId', 2); //default user is customer
            $stmt->bindValue(':email', $email);
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e);
        }
        return false;
    }

    public function getByUsername($username)
    {
        $stmt = $this->connection->prepare('SELECT * FROM user WHERE username = :username');
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        $user = new User();
        $user->setId($row['id']);
        $user->setUsername($row['username']);
        $user->setPassword($row['password']);
        $user->setEmail($row['email']);
        $user->setRole($row['roleId']);

        return $user;
    }

    public function getById($id)
    {
        $stmt = $this->connection->prepare('SELECT * FROM user WHERE id = :id');
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
        $user->setEmail($row['email']);
        $user->setRole($row['roleId']);

        return $user;
    }
}
