<?php
require_once '../../includes/database.php';

// Start session because I need the first and Last name of employee.
session_start();

// Create connection

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: ". mysqli_connect_error());

$queryAll = "SELECT * FROM pending_requests WHERE status ='0'"; // fix this later, code still works

$result = mysqli_query($db, $queryAll);


// Create array & store from the database

$pending_requests = [];

while($row = mysqli_fetch_assoc($result)) {
    $pending_requests[] = $row;
}


// Close connection

mysqli_close($db);

// PHP SELF (GET the currentID)

$currentId = $_GET['id'];

print_r($currentId);


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Bekijk de status van je aanvragen </title>

</head>
<body>
  <h1> Bekijk de status van je aanvragen </h1>

  <ul>

    <?php foreach($pending_requests as $key => $items) { ?>
        <li>
            <p><?= $items['first_name'] ?></p>
            <p><?= $items['request'] ?></p>
            <p><?= $items['date'] ?></p>
            <a href="?id=<?= $items['id'] ?>">
                <button>WEIGEREN</button>
            </a>
            <a href="?id=<?= $items['id'] ?>">
                <button>ACCEPTEREN</button>
            </a>
        </li>
    <?php }
    ?>

  </ul>
</body>
</html>
