<?php

namespace CaterpillarOS\Entities;

class UserEntity implements \JsonSerializable
{
    private int $id;
    private string $username;
    private ?string $password;
    private ?string $icon;

    private ?bool $needspassword;
    private int $theme;

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id,
            "username" => $this->username,
            "icon" => $this->icon,
            "needspassword" => $this->needspassword,
//            "theme" => $this->theme
        ];
    }
}