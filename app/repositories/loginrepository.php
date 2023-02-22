<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';
class LoginRepository extends Repository
{
    public function login($username, $password)
    {
        $user = $this->getByUsername($username);

        if (password_verify($password, $user->getPassword())) {
            return true;
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
}
