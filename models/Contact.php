<?php

class Contact
{
    //DB Stuff
    private $conn;
    private $table = "login";

    //Contact Properties
    public $id;
    public $name;
    public $email;
    public $issue;
    public $comment;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get Single Contact
    public function get_single()
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";

        //Prepate PDO
        $stmt = $this->conn->prepare($sql);

        //Bind ID
        $stmt->bindParam(":id", $this->id);

        //Execute PDO
        $stmt->execute();

        //Make Result an Array
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set Properties
        $this->name = $contact["name"];
        $this->email = $contact["email"];
        $this->issue = $contact["issue"];
        $this->comment = $contact["comment"];

    }

    //Update Contact
    public function update()
    {

    }
}