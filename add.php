<?php

$errs = ["email" => "","title" => "","text"=> ""];
$email = $title = $text = ""; // You can  assign the same value to more than variable

if (isset($_POST["submit"])) { // When we click on submit INPUT
    // if (isset($_POST["email"])) {// if there is a value
    //     echo htmlspecialchars($_POST["email"]); /// htmlspecialchars prevent code injection
    // }
    // if (isset($_POST["title"])) {// if there is a value
    //     echo htmlspecialchars($_POST["title"]);
    // }
    // if (isset($_POST["text"])) {// if there is a value
    //     echo htmlspecialchars($_POST["text"]);
    // }

    // We can use empty the opposite of isset

    $email = $_POST["email"];
    $title = $_POST["title"];
    $text = $_POST["text"];

    function checker($value)
    {
        global $errs;
        global $email;
        global $title;
        global $text;
        if (empty(htmlspecialchars($_POST[$value]))) {
            $errs[$value] = "$value is required <br />";
        } else {
            if ($value == "email") {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errs[$value] = "Please enter a valid email address <br />";
                }
            } elseif ($value == "title") {
                if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
                    // regular expresions function
                    // {^} match any char not in the regExp {+} mean more than one charachter {$} match the end of string only {\s} matches white spaces
                    $errs["title"] = "Title should be in letters and spaces only <br />";
                }
            } elseif ($value == "text") {
                if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $text)) {
                    $errs[$value] = "You should add separated comma between words <br />";
                }
            }
        }
    }

    checker("email");
    checker("title");
    checker("text");

    if (array_filter($errs)) {// array_filter($array) delete empty values then returns false. if it didn't remove returns true
        // echo "There are errs in the form.";
    } else {
        $connect = mysqli_connect("localhost", "abdo", "12345", "abdo_pizzas");
        //To prevent SQL injection
        $email = mysqli_real_escape_string($connect, $email);
        $text = mysqli_real_escape_string($connect, $text);
        $title = mysqli_real_escape_string($connect, $title);
        $sql = "INSERT INTO pizzas (title, text, email) VALUES ('$title', '$text', '$email')";
       
        mysqli_query($connect, $sql);
        mysqli_close($connect);
        header("Location: ./index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php require "./header.php"; ?>
<section class="container">
    <h4 class="display-4 text-center">Add A Pizza</h4>
    <form action="./add.php" method="POST" class="p-md-5 d-flex flex-column bg-light">
        <label>Your Email:</label>
        <input class="form-control" type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"/>
        <div class='text-danger'><?php echo $errs["email"]; ?></div>
        <label>Pizza Title:</label>
        <input class="form-control" type="text" name="title" value="<?php echo htmlspecialchars($title); ?>"/>
        <div class='text-danger'><?php echo $errs["title"]; ?></div>
        <label>Some Text:</label>
        <input class="form-control" type="text" name="text" value="<?php echo htmlspecialchars($text); ?>"/>
        <div class='text-danger'><?php echo $errs["text"]; ?></div>
        <input type="submit" name="submit" class="m-3 btn btn-primary btn-lg align-self-center text-uppercase" value="Add" />
    </form>
    <!-- <form method="POST" action = "" style="width:80%;margin: 10px auto;">
        <input style="width:80%;margin:0 10px;" placeholder="Enter your name to test sessions" type="text" name="username" />
        <input type="submit" name="submitName" class="m-3 btn btn-primary btn-lg align-self-center text-uppercase"/>
    </form> -->
</section>

<?php require "./footer.html"; ?>

</html>
