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

    function getRoles()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM roles");
            $stmt->execute();
            $roles = $stmt->fetchAll();

            return $roles;
        } catch (PDOException $e) {
            echo $e;
        }
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
        $stmt = $this->connection->prepare('SELECT user.*, roles.name AS roleName
        FROM user
        JOIN roles ON user.roleId = roles.id
        WHERE user.id = :id');

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
        $user->setRoleName($row['roleName']);

        return $user;
    }

    public function save(User $user)
    {
        try {
            if (!$user->getId() == 0) {
                // Update existing user
                $query = 'UPDATE user SET username = :username, password = :password, roleId = :roleId, email = :email WHERE id = :id';
                $stmt = $this->connection->prepare($query);
                $stmt->bindValue(':username', $user->getUsername());
                $stmt->bindValue(':password', $user->getPassword());
                $stmt->bindValue(':roleId', $user->getRole());
                $stmt->bindValue(':email', $user->getEmail());
                $stmt->bindValue(':id', $user->getId());
                $stmt->execute();
            } else {
                // Insert new user
                $query = 'INSERT INTO user (username, password, roleId, email) VALUES (:username, :password, :roleId, :email)';
                $stmt = $this->connection->prepare($query);
                $stmt->bindValue(':username', $user->getUsername());
                $stmt->bindValue(':password', $user->getPassword());
                $stmt->bindValue(':roleId', $user->getRole());
                $stmt->bindValue(':email', $user->getEmail());
                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo ($e);
        }
        if ($stmt) {
            return true;
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
