<?php 

require_once("config/heroku_db.php");

//Get ID from URL
$id = $_GET['id'];
echo $id;

// //Create MySQL query
// $sql = "SELECT * FROM login WHERE id = $id";

// //Send query
// $result = mysqli_query($conn, $sql);

// echo $result;

?>

<?php require_once("templates/header.php"); ?>
<div class="new-user">
    <h2>Message Sent</h2>
    <div>
        Username:
    </div>
    <div>
        Email:
    </div>
    <div>
        Issue:
    </div>
    <div>
        Comment: 
    </div>
</div>

<?php require_once("templates/footer.php"); ?>