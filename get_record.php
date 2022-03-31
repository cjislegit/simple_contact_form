<?php

function get_record()
{
    require_once "config/heroku_db.php";

//Get ID from URL
    $id = $_GET['id'];

//Create MySQL query
    $sql = "SELECT * FROM login WHERE id = $id";

//Send query
    // $result = mysqli_query($conn, $sql);
    if (mysqli_query($conn, $sql)) {
        echo "It worked";

    } else {
        //If there is an error is is diplayed
        echo mysqli_error($conn);
    }

//Make result an array
    $contact = mysqli_fetch_assoc($result);

    return $contact;

}