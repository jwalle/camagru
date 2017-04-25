<?php

class Database
{

    private $pdo;

    public function __construct($host, $db_name, $DB_USER, $DB_PASSWORD)
    {
        $this->pdo = new PDO("mysql:dbname=$db_name;host=$host", $DB_USER, $DB_PASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query($query, $params)
    {
        $req = null;
        try {
            $req = $this->pdo->prepare($query);
            $req->execute($params);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $req;
    }

    public function lastInsertId(){
        return $this->pdo->lastInsertId();
    }
}