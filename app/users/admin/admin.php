<?php
session_start();

// May I even visit this page?

// If I don't have the login variable then.. i will redirect back to login page.
if(!isset($_SESSION['type'] == 'admin')) {
    header("Location: index.php");
    exit;
}

// Get email from session (you've stored email in SESSION login)

$email = $_SESSION['login'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Hele belangrijke info!</title>
</head>
<body>
    <h1> Heel belangrijk! </h1>
    <p> U bent ingelogd als <?= $email; ?> </p>
    <a href="logout.php"> Uitloggen </a>
</body>
</html>
