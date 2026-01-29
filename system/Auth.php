<?php

class Auth {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            // Reusing the Medoo connection logic could be better, but for now standard PDO
            $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
            self::$instance = new \Delight\Auth\Auth($db);
        }
        return self::$instance;
    }

    public static function check() {
        return self::getInstance()->isLoggedIn();
    }

    public static function id() {
        return self::getInstance()->getUserId();
    }
    
    public static function user() {
        return self::getInstance();
    }
}
