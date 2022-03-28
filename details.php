<?php

require_once "config/heroku_db.php";

//Get ID from URL
$id = $_GET['id'];

//Create MySQL query
$sql = "SELECT * FROM login WHERE id = $id";

//Send query
$result = mysqli_query($conn, $sql);

//Make result an array
$contact = mysqli_fetch_assoc($result);

?>

<?php require_once "templates/header.php";?>
<div class="new-user">
    <h2>Message Sent</h2>
    <form action="POST">
        <label for="username">Username: </label>
        <input type="text" name="username" value="<?php echo $contact["name"]; ?>">

        <label for="email">Email: </label>
        <input type="email" name="email" value="<?php echo $contact["email"]; ?>">

        <label for="issue">Issue: </label>
        <select name="issue" id="issue">
            <option <?php if ($contact["issue"] == "query") {echo "selected";}?> value="query">Query</option>
            <option <?php if ($contact["issue"] == "feedback") {echo "selected";}?> value="feedback">Feedback</option>
            <option <?php if ($contact["issue"] == "complaint") {echo "selected";}?> value="complaint">Complaint
            </option>
            <option <?php if ($contact["issue"] == "other") {echo "selected";}?> value="other">Other</option>
        </select>

        <label for="comment"></label>
        <textarea name="comment" id="comment" cols="30" rows="10"><?php echo $contact["comment"]; ?></textarea>

    </form>
</div>


<?php require_once "templates/footer.php";?>