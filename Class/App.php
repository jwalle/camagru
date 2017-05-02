<?php

class App {

    static $db = null;

    static function getDatabase(){
        if (!self::$db) {
            self::$db = new Database();
        }
        return self::$db;
    }

    static function getAuth() {
        return new Auth(Session::getInstance());
    }

    static function getGallery() {
        self::getDatabase();
        return new Gallery(self::$db);
    }

    static function getImage($img_id) {
        return new Image(self::$db, $img_id);
    }

    static function redirect($url) {
        header("Location: $url");
    }

    static function str_random($length) {
        $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }
}