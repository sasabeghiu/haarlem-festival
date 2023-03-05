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

    public function validateUser($user, $id)
    {
        $stmt = $this->connection->prepare('SELECT * FROM user WHERE email= :email AND username = :username AND id != :id');

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->execute();
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return $user;
    }

    public function createUser($id, User $user)
    {
        try {
            // Insert new user
            $query = 'INSERT INTO user (username, password, roleId, email) VALUES (:username, :password, :roleId, :email)';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':username', $user->getUsername());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':roleId', $user->getRole());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->execute();
        } catch (PDOException $e) {
            echo ($e);
        }
        if ($stmt) {
            return true;
        }
    }

    public function updateUser(User $user)
    {
        $id = $user->getId();
        $username = $user->getUsername();
        $email = $user->getEmail();
        $role = $user->getRole();
        $password = $user->getPassword();
        $params = array();
        $set_string = '';

        if (!empty($username)) {
            $set_string .= 'username = :username, ';
            $params[':username'] = $username;
        }
        if (!empty($email)) {
            $set_string .= 'email = :email, ';
            $params[':email'] = $email;
        }
        if (!empty($role)) {
            $set_string .= 'role = :role, ';
            $params[':role'] = $role;
        }
        if (!empty($password)) {
            $set_string .= 'password = :password, ';
            $params[':password'] = $password;
        }

        $set_string = rtrim($set_string, ', ');

        $query = "UPDATE users SET $set_string WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $params[':id'] = $id;
        return $stmt->execute($params);
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
