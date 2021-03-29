<?php
namespace App\Validator;

class ClassroomValidator
{
    const NAME_REGEX = '/^[a-zA-Z]{2,60}$/';

    public static function isNameValid(?string $name): bool
    {
        return preg_match(self::NAME_REGEX, $name) === 1;
    }
}
