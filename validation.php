<?php

class Validation
{
    public static function isNotNullOrEmpty($str)
    {
        return isset($str) && !empty($str);
    }

    public static function isNullOrEmpty($str)
    {
        return !self::isNotNullOrEmpty($str);
    }

    public static function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
