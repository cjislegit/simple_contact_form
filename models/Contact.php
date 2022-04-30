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
        //Create Query
        $sql = "UPDATE login SET name = :name, email = :email, issue = :issue, comment = :comment WHERE id = :id";

        //Prepare PDO
        $stmt = $this->conn->prepare($sql);

        //Clean Data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->issue = htmlspecialchars(strip_tags($this->issue));
        $this->comment = htmlspecialchars(strip_tags($this->comment));

        //Bind Data
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":issue", $this->issue);
        $stmt->bindParam(":comment", $this->comment);

        //Execute Query
        if ($stmt->execute()) {
            return true;
        } else {
            //Print Error
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

    }
}