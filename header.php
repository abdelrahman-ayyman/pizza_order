<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <title>My PHP Project</title>
</head>

<body>
    <header>
        <nav class="d-flex bg-light justify-content-around">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active display-4" href="./index.php">Abdo Pizza</a>
                </li>
            </ul>
            <?php
            session_start(); // Start Session :It stores data in the server untill the window is closed
            //To remove session value we use
            // unset($_SESSION["name"]);
            //To remove all session values we use
            // session_unset();
            session_regenerate_id(); // To prevent session fixation
            if (isset($_POST["submitName"])) {
                $_SESSION["name"] = $_POST["username"];
            }
            // if first value exists set name value as it else (??) name = "Guest"
            $name = $_SESSION["name"] ?? "Guest";
            echo "<h4 class='align-self-center'>Hello " . htmlspecialchars($name) . "</h4>";

            ?>
            <a href="./add.php" class="text-white btn btn-primary align-self-center text-uppercase">Add
                A Pizza</a>
        </nav>
    </header>
