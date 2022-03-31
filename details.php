<?php

require_once "config/heroku_db.php";
require_once "/get_record.php";

get_record($conn);

if (isset($_POST["submit"])) {

    //Make input to strings and then set variables
    $name = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $issue = mysqli_real_escape_string($conn, $_POST["issue"]);
    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);

    //Create the sql querry
    $sql = "UPDATE login SET name='$name', email='$email', issue='$issue', comment='$comment' WHERE id='$id'";

    //Save to db
    if (mysqli_query($conn, $sql)) {
        echo "It worked";

    } else {
        //If there is an error is is diplayed
        echo mysqli_error($conn);
    }

}

?>

<?php require_once "templates/header.php";?>
<div class="new-user">
    <h2>Message Sent</h2>
    <form method="POST">
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

        <input type="submit" value="submit" name="submit">
    </form>
</div>


<?php require_once "templates/footer.php";?>