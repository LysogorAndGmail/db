<?php

class Database
{
    // DB Params
    private $host = 'localhost';
    private $db_name = 'sys';
    private $username = 'root';
    private $password = '';
    private $conn;

    // DB Connect
    private function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }

    public function myQuery($sql)
    {
        $this->connect();
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
    }

    private function disconnect()
    {
        $this->conn = null;
    }

}