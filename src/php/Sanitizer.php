<?php
// singleton? o static para no tener que crear objeto? un array reduce con lo de abajo? 
class Sanitizer
{   
    public static function basicSanitize(mixed $input): mixed {
        if (is_array($input)) {
            foreach ($input as $key => $value) {
                $input[$key] = self::basicSanitize($value);
            }
        } else {
            $input = self::sanitize($input);
        }
        return $input;
    
    }
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
}