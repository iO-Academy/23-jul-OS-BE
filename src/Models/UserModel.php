<?php

namespace CaterpillarOS\Models;

use CaterpillarOS\Entities\UserEntity;

class UserModel
{
    private \PDO $db;

    /**
     * @param \PDO $db
     */
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function getAllUsers()
    {
        $query = $this->db->prepare('SELECT `id`,`username`,`password`,`icon`,`theme` FROM `users`');
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS, UserEntity::class);
        return $query->fetchAll();
    }
    public function getUserById(int $userId)
    {
        $query = $this->db->prepare('SELECT `id`,`username`,`password`,`icon`,`theme` FROM `users` WHERE `id` = ?' );
        $query->execute([$userId]);
        $query->setFetchMode(\PDO::FETCH_CLASS, UserEntity::class);
        return $query->fetch();
    }

}