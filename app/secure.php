<?php

session_start();

// May I even visit this page?

// If I don't have the login variable then.. i will redirect back to login page.
if($_SESSION['type'] != 'admin') {
    header("Location: index.php");
    exit;
}

$name = $_SESSION['name'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Hele belangrijke info!</title>
</head>
<body>
    <h1> Heel belangrijk! </h1>
    <p> U bent ingelogd als <?= $name ?> </p>
    <a href="logout.php"> Uitloggen </a>
</body>
</html>
