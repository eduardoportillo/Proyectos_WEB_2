<?php

namespace App\models\conexion;

use PDO;

class ConexionDB
{
    private $db = "proyecto_1_web_2";
    private $host = "127.0.0.1";
    private $port = 3306;
    private $username = "root";
    private $password = "";
    private $connection;


    function getConnection()
    {
        if ($this->connection == null) {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        return $this->connection;
    }

    function query($csql)
    {
        return $this->getConnection()->query($csql);
    }

    function queryWithParams($csql, $paramArray)
    {
        $q = $this->getConnection()->prepare($csql);
        $q->execute($paramArray);
        return $q;
    }

    function getLastInsertedId()
    {
        return $this->getConnection()->lastInsertId();
    }
}


