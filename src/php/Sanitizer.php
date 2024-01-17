<?php
class Sanitizer
{
    public static function sanitize(mixed $input): mixed
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    public static function sanitizeEmail(string $email): string
    {
        $email = Sanitizer::sanitize($email);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        return $email;
    }

    // function that validates an email
    public static function validateEmail(string $email): bool
    {
        $email = Sanitizer::sanitize($email);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    public static function sanitizeString(string $string): string
    {
        $string = Sanitizer::sanitize($string);
        return $string;
    }

    public static function sanitizeInt(int $int): int
    {
        $int = filter_var($int, FILTER_SANITIZE_NUMBER_INT);
        return $int;
    }

    public static function sanitizeFloat(float $float): float
    {
        $float = filter_var($float, FILTER_SANITIZE_NUMBER_FLOAT);
        return $float;
    }

    public static function sanitizeUrl(string $url): string
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return $url;
    }
}