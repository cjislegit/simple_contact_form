<?php

// require_once "config/heroku_db.php";
require_once "config/heroku_db_local.php";
require_once "user_validator.php";
require_once "config/Database.php";
require_once "models/Contact.php";

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate new_contact Object
$new_contact = new Contact($db);

//Get ID
$new_contact->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get new_contact
$new_contact->get_single();

$errors = [];
$name = "";
$email = "";
$issue = "";
$comment = "";
$result = "";

//Check if info has been updated
if ($_GET["updated"]) {
    $update = "<div class='success'>Message Updated</div>";

} else {
    $update = "";
}

if (isset($_POST["submit"])) {
    //validate entries
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();

    if (!array_filter($errors)) {
        //Make input to strings and then set variables
        $name = $_POST["username"];
        $email = $_POST["email"];
        $issue = $_POST["issue"];
        $comment = $_POST["comment"];

//Create the sql querry
        $sql = "UPDATE login SET name = :name, email = :email, issue = :issue, comment = :comment WHERE id = :id";

        $stmt = $pdo->prepare($sql);

//Save to db
        if ($stmt->execute(["name" => $name, "email" => $email, "issue" => $issue, "comment" => $comment, "id" => $id])) {
            header("Location: details.php?id=$id&updated=true");

        } else {
            //If there is an error is is diplayed
            $update = mysqli_error($conn);
        }

    } else {
        $update = "";

    }

}

?>

<?php require_once "templates/header.php";?>
<div class="new-user">
    <a href="index.php">Back</a>
    <h2>Message Sent</h2>
    <?php echo $update ?>
    <form method="POST">
        <label for="username">Username: </label>
        <input type="text" name="username" value="<?php echo $new_contact->name; ?>">
        <div class="error">
            <?php echo $errors["username"] ?? "" ?>
        </div>

        <label for="email">Email: </label>
        <input type="email" name="email" value="<?php echo $new_contact->email; ?>">
        <div class="error">
            <?php echo $errors["email"] ?? "" ?>
        </div>

        <label for="issue">Issue: </label>
        <select name="issue" id="issue">
            <option <?php if ($new_contact->issue == "query") {echo "selected";}?> value="query">Query</option>
            <option <?php if ($new_contact->issue == "feedback") {echo "selected";}?> value="feedback">Feedback
            </option>
            <option <?php if ($new_contact->issue == "complaint") {echo "selected";}?> value="complaint">Complaint
            </option>
            <option <?php if ($new_contact->issue == "other") {echo "selected";}?> value="other">Other</option>
        </select>

        <label for="comment"></label>
        <textarea name="comment" id="comment" cols="30" rows="10"><?php echo $new_contact->comment; ?></textarea>

        <input type="submit" value="update" name="submit">
    </form>
</div>


<?php require_once "templates/footer.php";?>