<?php 

require_once("config/heroku_db.php");

//Get ID from URL
$id = $_GET['id'];

//Create MySQL query
$sql = "SELECT * FROM login WHERE id = $id";

//Send query
$result = mysqli_query($conn, $sql);

//Make result an array
$contact = mysqli_fetch_assoc($result);

?>

<?php require_once("templates/header.php"); ?>
<div class="new-user">
    <h2>Message Sent</h2>
    <div>
        Username: <?php echo $contact["name"]; ?>
    </div>
    <div>
        Email: <?php echo $contact["email"]; ?>
    </div>
    <div>
        Issue: <?php echo $contact["issue"]; ?>
    </div>
    <div>
        Comment: <?php echo $contact["comment"]; ?> 
    </div>
</div>
<form action="POST">
    <label for="username">Username: </label>
    <input type="text" name="username" value="<?php echo $contact["name"]; ?>">

    <label for="email">Email: </label>
    <input type="email" name="email" value="<?php echo $contact["email"]; ?>">

    <label for="issue">Issue: </label>
    <select name="issue" id="issue" value="<?php echo $contact["issue"]; ?>">
        <option value="query">Query</option>
        <option value="feedback">Feedback</option>
        <option value="complaint">Complaint</option>
        <option value="other">Other</option>
    </select>

    <label for="comment"></label>
    <textarea name="comment" id="comment" cols="30" rows="10" value="<?php echo $contact["comment"]; ?> "></textarea>

</form>

<?php require_once("templates/footer.php"); ?>