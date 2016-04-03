<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 12:47
 */
class DbConnection
{
    static private $servername = "localhost";
    static private $username = "chirpadmin";
    static private $password = "whatever";
    static private $baseName = "chirpper";

    static public function GetConnection()
    {
        $conn = new mysqli(self::$servername, self::$username, self::$password, self::$baseName);

        if ($conn->connect_errno != 0) {
            die($conn->connect_errno);
        } else {
            return $conn;
        }
    }

    private function __construct()
    {

    }
}