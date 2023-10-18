<?php

namespace Tests\Validators;

use CaterpillarOS\Validators\PasswordValidator;
use PHPUnit\Framework\TestCase;

class PasswordValidatorTest extends TestCase
{
    public function testSuccessPasswordsMatch()
    {
        $result = PasswordValidator::checkPassword('password', 'password');
        $expected = true;

        $this->assertEquals($expected, $result);
    }

    public function testSuccessPasswordsDoNotMatch()
    {
        $result = PasswordValidator::checkPassword('foo', 'password');
        $expected = false;

        $this->assertEquals($expected, $result);
    }

    public function testMalformedWrongDataTypeForEnteredPassword()
    {
        $this->expectException(\TypeError::class);
        PasswordValidator::checkPassword([], 'foo');
    }

    public function testMalformedWrongDataTypeForDbPassword()
    {
        $this->expectException(\TypeError::class);
        PasswordValidator::checkPassword('foo', []);
    }
}
