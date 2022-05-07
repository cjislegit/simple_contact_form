<?php

class Database
{
    //DB Params
    private $host = "us-cdbr-east-05.cleardb.net";
    private $db = "heroku_a7099b313dcb6d0";
    private $username = "b6fd6a09583b65";
    private $password = "90681e8a";
    private $conn;

    //DB Connect
    public function connect()
    {
        $this->conn = null;

        try {
            //Creating PDO Instance
            $this->conn = new PDO("mysql:host=$this->host; dbname=$this->db", $this->username, $this->password);

            //Turring on Erros in PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $error) {
            echo "Connection Error: $error->getMessage();";
        }

        return $this->conn;
    }
}