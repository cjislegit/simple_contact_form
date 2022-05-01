<?php

require_once "user_validator.php";
// require_once "config/heroku_db.php";
// require_once "config/heroku_db_local.php";
require_once "config/Database.php";
require_once "models/Contact.php";

//Instantiate DB $ Connect
$database = new Database();
$db = $database->connect();

//Instantiate Contact Object
$new_contact = new Contact($db);

$errors = [];

if (isset($_POST["submit"])) {
    //validate entries
    $validatoin = new UserValidator($_POST);
    $errors = $validatoin->validateForm();

    //save data to db

    if (!array_filter($errors)) {
        //Makes sure the input is strings and then sets the variables to the user input
        $new_contact->name = $_POST["username"];
        $new_contact->email = $_POST["email"];
        $new_contact->issue = $_POST["issue"];
        $new_contact->comment = $_POST["comment"];

        //save to db

        //Checks for errors
        if ($new_contact->create()) {
            //If no error success message is diplayed
            header("Location: details.php?id=$new_contact->id");

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