<?php

namespace CaterpillarOS\Validators;

class PasswordValidator
{
    public static function checkPassword(string $enteredPassword, string $dbPassword): bool {
        if ($enteredPassword === $dbPassword) {
            return true;
        } else {
            return false;
        }
    }
}