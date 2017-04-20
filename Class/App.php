<?php

class App {

    static $db = null;

    static function getDatabase($DB_DSN, $DB_USER, $DB_PASSWORD){
        if (!self::$db) {
            self::$db = new Database($DB_DSN, 'camagru', $DB_USER, $DB_PASSWORD);
        }
        return self::$db;
    }

    static function getAuth() {
        return new Auth(Session::getInstance());
    }

    static function redirect($url)
    {
        header("Location: $url");
    }

    static function str_random($length) {
        $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }
}