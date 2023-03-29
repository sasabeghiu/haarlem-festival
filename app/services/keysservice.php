<?php
require __DIR__ . '/../repositories/keysrepository.php';

class KeysService
{
    private $keysrepository;

    function __construct()
    {
        $this->keysrepository = new KeysRepository();
    }

    public function addKey($jwt)
    {
        $this->keysrepository->addKey($jwt);
    }
}
