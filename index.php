<?php
// First you should make the connection
//                        domain name  username    pass   database name
$sql_con = mysqli_connect("localhost", "abdo", "12345", "abdo_pizzas");

// What do you want from this data

$sql = "SELECT id,text,title FROM pizzas ORDER BY created_at";

// Collecting results
$result = mysqli_query($sql_con, $sql);

//Put results in array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

//freeing results from memory
mysqli_free_result($result);

//close the connection
mysqli_close($sql_con);

?>
<!DOCTYPE html>
<html lang="en">
    <?php require "./header.php"; ?>
    <div class='container d-flex align-items-stretch justify-content-md-center flex-wrap'>
        <?php foreach ($pizzas as $pizza): //New way to write foreach?>
            <div class="bg-light p-3 text-center m-3" style="width:350px;">
                <header>
                    <h5><?php echo htmlspecialchars($pizza['title']) ?></h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?php echo str_replace(",", '<li class="list-group-item">', htmlspecialchars($pizza['text'])); ?></li>
                    </ul>
                </header>
                <footer>
                <a href="details.php?id=<?php echo $pizza['id'] ?>" class="text-white btn btn-primary align-self-center text-uppercase m-3">more info</a>
                </footer>
            </div>
        <?php endforeach;//how you close the new way?>
    </div>
    <?php require "./footer.html"; ?>
</html>
