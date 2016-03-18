<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 12:47
 */
class DbConnection
{
    private static $servername = "localhost";
    private static $username = "chirpadmin";
    private static $password = "whatever";
    private static $baseName = "chirpper";

    public static function getConnection(){
        $conn = new mysqli(self::$servername, self::$username, self::$password, self::$baseName);

        if ($conn->connect_error) {
            return false;
        }
        return $conn;
    }
}