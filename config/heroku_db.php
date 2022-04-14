<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

// $conn = new mysqli($server, $username, $password, $db);

//DPO Setup

//Create DSN
$dsn = "mysql:host=$server;dbname=$db;";

//Create PDO Instance
$pdo = new PDO($dsn, $user, $password);