<?php

class Database
{

    private $pdo;

    public function __construct()
    {
        include rootPath . '/config/database.php';
        $this->pdo = new PDO("mysql:dbname=$DB_NAME;host=$DB_DSN", $DB_USER, $DB_PASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @param $query
     * @param $params
     * @return null|PDOStatement
     */
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