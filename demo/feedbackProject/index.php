<?php
#header
require "components/header.php";
#Code php here
$name = $email = $feedback = "";
$name_error = $email_error = $feedback_error = '';

if (isset($_POST["submit"])) {
    if (empty($_POST["name"])) {
        $name_error = "Name is required";
    }
    if (empty($_POST["email"])) {
        $email_error = "Email is required";
    }
    if (empty($_POST["feedback"])) {
        $feedback_error = "Feedback is required";
    }

    $validate_sucess = empty($name_error)
                        && empty($email_error)
                        && empty($feedback_error);

    if ($validate_sucess) {
        $name = htmlspecialchars($_POST["name"]);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $feedback = filter_input(INPUT_POST, "feedback", FILTER_SANITIZE_SPECIAL_CHARS);

        $insertQuery = "insert into comments(Name,Email,Feedback) values(:name,:email,:feedback)";
        try {
            echo "start set paramater";
            $query = $connection->prepare($insertQuery);
            $query->bindParam(":name", $name);
            $query->bindParam(":email", $email);
            $query->bindParam(":feedback", $feedback);
            $query->execute();
            //echo "insert successfully";
            //insert successfully
            header("Location: feedback_list.php");
        } catch (PDOException $e) {
            echo "Cannot insert feedback into database"
                . $e->getMessage();
        }
    }
}

?>
<!-- Body page -->
<div class="mt-3 mb-3">
    <h1>Enter your feedback here</h1>
    <a href="./feedback_list.php" class="btn btn-secondary mb-3">List feedback</a>
</div>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="form-group mb-3">
        <input type="text" class="form-control 
        <?php echo $name_error? "is-invalid": ""; ?>" id="name" name="name" placeholder="What is your name?">
        <p class="text-danger">
            <?php echo $name_error; ?>
        </p>
    </div>
    <div class="form-group mb-3">
        <input type="email" class="form-control 
        <?php echo $email_error? "is-invalid": ""; ?>" id="email" name="email" placeholder="Enter your email">
        <p class="text-danger">
            <?php echo $email_error; ?>
        </p>
    </div>

    <div class="form-group mb-3">
        <textarea class="form-control 
        <?php echo $feedback_error? "is-invalid": ""; ?>" id="feedback" name="feedback" rows="3" 　 placeholder="Enter feedback"></textarea>
        <p class="text-danger">
            <?php echo $feedback_error; ?>
        </p>
    </div>

    <div class="form-group mb-3">
        <input type="submit" class="btn btn-primary" id="send" value="Send" name="submit" />
    </div>
</form>

<!-- include footer -->
<?php include "components/footer.php"; ?>