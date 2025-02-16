<?php

namespace App\core;

// класс генерации токена
// не используется, но включен для будущей авторизации
class CSRF
{
    public static function create_token()
    {    // метод генерации токена
        $token = hash('gost-crypto', random_int(0, 999999));
        $_SESSION['token'] = $token;
        return $token;
    }

    public static function validate($token)
    {                       // метод проверки токена
        return isset($_SESSION['token']) && $_SESSION['token'] == $token;
    }
}