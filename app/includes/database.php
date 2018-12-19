<?php

// Credentials

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'banzai';

// Create connection

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: ". mysqli_connect_error());

// Create query for db & fetch result

// Fetching pending requests, because the admin has to see the pending requests.

$queryAll = "SELECT * FROM pending_requests"; // fix this later, code still works


$result = mysqli_query($db, $queryAll);


// Create array & store from the database

$pending_requests = [];

while($row = mysqli_fetch_assoc($result)) {
    $pending_requests[] = $row;
}



// Close connection

mysqli_close($db);


?>
