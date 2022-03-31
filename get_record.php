<?php

function get_record($conn)
{
//Get ID from URL
    $id = $_GET['id'];

//Create MySQL query
    $sql = "SELECT * FROM login WHERE id = $id";

//Send query
    $result = mysqli_query($conn, $sql);

//Make result an array
    $contact = mysqli_fetch_assoc($result);

}