<?php

namespace CaterpillarOS\Factories;

class PDOFactory
{
    private string $dsn = 'mysql:dbname=caterpillar-os;host=db';
    private string $username = 'root';
    private string $password = 'password';

    public function __invoke(): \PDO
    {
        $db = new \PDO($this->dsn,$this->username,$this->password);
        $db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
        return $db;
    }
}