<?php

require_once "user_validator.php";
// require_once "config/heroku_db.php";
require_once "config/heroku_db_local.php";

$errors = [];
$name = "";
$email = "";
$issue = "";
$comment = "";
$result = "";

if (isset($_POST["submit"])) {
    //validate entries
    $validatoin = new UserValidator($_POST);
    $errors = $validatoin->validateForm();

    //save data to db

    if (!array_filter($errors)) {
        //Makes sure the input is strings and then sets the variables to the user input
        $name = mysqli_real_escape_string($conn, $_POST["username"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $issue = $_POST["issue"];
        $comment = mysqli_real_escape_string($conn, $_POST["comment"]);

        //Creates the sql query
        $sql = "INSERT INTO login(name, email, issue, comment) VALUES('$name', '$email', '$issue', '$comment')";

        //save to db

        //Checks for errors
        if (mysqli_query($conn, $sql)) {
            //If no error success message is diplayed
            $new_id = mysqli_insert_id($conn);
            $result = "<div class='success'>Account Added</div>";
            header("Location: details.php?id=$new_id");

        } else {
            //If there is an error is is diplayed
            $result = " <div class='error'>Query Error: mysqli_error($conn)</div>";
        }

    }

}

?>

<?php require_once "templates/header.php"?>
<div class="new-user">
    <h2>Contact Form</h2>
    <div><?php echo $result ?></div>

    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($_POST["username"] ?? "") ?>">
        <div class="error">
            <?php echo $errors["username"] ?? "" ?>
        </div>

        <label>Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($_POST["email"] ?? "") ?>">
        <div class="error">
            <?php echo $errors["email"] ?? "" ?>
        </div>

        <label>Issue:</label>
        <select name="issue" id="issue">
            <option value="query">Query</option>
            <option value="feedback">Feedback</option>
            <option value="complaint">Complaint</option>
            <option value="other">Other</option>
        </select>

        <label>Comment:</label>
        <textarea id="comment" name="comment" cols="30" rows="10"
            value="<?php echo htmlspecialchars($_POST["comment"] ?? "") ?>"><?php echo htmlspecialchars($_POST["comment"] ?? "") ?></textarea>

        <input type="submit" value="submit" name="submit">
    </form>
</div>
<?php require_once "templates/footer.php"?>