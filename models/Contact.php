<?php

class Contact
{
    //DB Stuff
    private $conn;
    private $table = "login";

    //Contact Properties
    private $id;
    private $name;
    private $email;
    private $issue;
    private $comment;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get Single Post
    public function get_single()
    {
        $sql = "SELECT * FROM login WHERE id = :id";

        //Prepate PDO
        $stmt = $this->conn->prepare($sql);

        //Execute PDO
        $stmt->execute();

        //Make Result an Array
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);

        return $contact;

    }
}