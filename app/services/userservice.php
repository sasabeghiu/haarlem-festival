<?php
require __DIR__ . '/../repositories/userrepository.php';
class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getAll()
    {
        $repository = new UserRepository();
        return $repository->getAll();
    }

    public function getRoles()
    {
        $repository = new UserRepository();
        return $repository->getRoles();
    }

    public function getById($id)
    {
        $repository = new UserRepository();
        return $repository->getById($id);
    }

    public function getByUsername($username)
    {
        $repository = new UserRepository();
        return $repository->getByUsername($username);
    }

    public function deleteById($id)
    {
        $repository = new UserRepository();
        return $repository->deleteById($id);
    }

    public function saveUser(User $user)
    {
        $repository = new UserRepository();
        return $repository->save($user);
    }

    public function validateUser(User $user)
    {
        $repository = new UserRepository();
        if ($repository->getbyUsername($user->getUsername())) {
            return false; //user exists
        }
        return true;
    }
}
