<?php
if (isset($_GET['id'])) {
    $sql_con = mysqli_connect("localhost", "abdo", "12345", "abdo_pizzas");

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // What do you want from this data

    $sql = "SELECT * FROM pizzas WHERE id = $id";

    // Collecting results
    $result = mysqli_query($sql_con, $sql);
    
    if (!mysqli_error($sql_con)) {
        //Put results in array
        $pizza = mysqli_fetch_assoc($result);

        //freeing results from memory
        mysqli_free_result($result);
    }
    if (isset($_POST["submit"])) {
        $sql = "DELETE FROM pizzas WHERE id = $id";
    
        if (mysqli_query($sql_con, $sql)) {
            mysqli_close($sql_con);
            header("Location: ./index.php");
        }
    }
    mysqli_close($sql_con);
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require "./header.php"; ?>
    <div class='container d-flex align-items-stretch justify-content-md-center flex-wrap text-center'>
        <?php if (isset($pizza)) : ?>
        <div>
            <h3><?php echo htmlspecialchars($pizza['title']); ?></h3>
            <p>Created by: <?php echo htmlspecialchars($pizza['email']) . "<br />"; ?> at: <?php echo htmlspecialchars($pizza['created_at']); ?></p>
            <p>Ingredients
                <ul class='list-group list-group-flush'>
                    <li class="list-group-item bg-light">
                    <?php echo str_replace(",", '<li class="list-group-item bg-light">', htmlspecialchars($pizza['text'])); ?>
                    </li>
                </ul>
            </p>
            <form method='POST' action=''>
                <input name="submit" type="submit" value="Delete" class="m-3 btn btn-primary btn-lg align-self-center"/>
            </form>
        </div>
        <?php else: ?>
            <h2>No sush pizza</h2>
        <?php endif; ?>
    </div>
<?php require "./footer.html"; ?>

</html>
