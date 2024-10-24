<?php


class Database
{


    private static $dbname = 'contact_form';
    private static $dbhost = 'localhost:3306';
    private static $dbUsername = 'root';
    private static $dbUserpasseword = '';
    private static $connexion = null;


    public function __construct()
    {
        die("function d'initialisation pas permise");
    }

    public static function connect()
    {
        if (null == self::$connexion) {
            try {
                self::$connexion = new PDO("mysql:host=" . self::$dbhost . ";dbname=" . self::$dbname.";charset=utf8mb4", self::$dbUsername, self::$dbUserpasseword);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$connexion;
    }



    public static function disconnect()
    {
        self::$connexion = null;
    }


}
