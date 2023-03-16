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
            $query = 'INSERT INTO user (username, password, roleId, email, created_at) VALUES (:username, :password, :roleId, :email, CURRENT_TIMESTAMP)';
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
    public function getByEmail($email)
    {
        $stmt = $this->connection->prepare('SELECT * FROM user WHERE email = :email');
        $stmt->bindValue(':email', $email);
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

    public function updatePassword($userId, $password)
    {
        try {
            $query = 'UPDATE user SET password = :pass WHERE id = :id';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':pass', $password);
            $stmt->bindValue(':id', $userId);
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e);
        }
        return false;
    }

    public function createVerificationCode($code)
    {
        try {
            $query = 'INSERT INTO verification_code (code) VALUES (:code)';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':code', $code);
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e);
        }
        return false;
    }

    public function getLast($code)
    {
        try {
            // Set the time limit to 10 minutes
            $timeLimit = 10; // in minutes
            // Get the datetime 10 minutes ago
            $datetimeLimit = date('Y-m-d H:i:s', strtotime('-' . $timeLimit . ' minutes'));

            $query = 'SELECT * FROM verification_code WHERE code = :code AND timestamp > :datetimeLimit';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':code', $code);
            $stmt->bindParam(':datetimeLimit', $datetimeLimit);
            $row = $stmt->fetch();
            if ($stmt->rowCount() > 0) {
                return $row['userId'];
            }
        } catch (PDOException $e) {
            print_r($e);
        }
        return false;
    }

    public function deleteCode($code)
    {
        $query = 'DELETE FROM verification_code WHERE code = :code';

        try {
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':code', $code);
            $stmt->execute();
            if ($stmt) {
                return true;
            }
        } catch (PDOException $e) {
            echo ($e);
        }
    }
}
