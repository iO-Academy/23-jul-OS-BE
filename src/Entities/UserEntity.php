<?php

namespace CaterpillarOS\Entities;

class UserEntity implements \JsonSerializable
{
    private int $id;
    private string $username;
    private ?string $password;
    private ?string $icon;
    private int $theme;

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id,
            "username" => $this->username,
            "password" => $this->password,
            "icon" => $this->icon,
            "theme" => $this->theme

        ];
    }

}