<?php

include '../../../vendor/autoload.php';

use Latitude\QueryBuilder\Engine\CommonEngine;
use Latitude\QueryBuilder\QueryFactory;

use function Latitude\QueryBuilder\field;

// Credentials

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'banzai';

// Create connection

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: ". mysqli_connect_error());



$factory = new QueryFactory(new CommonEngine());
$query = $factory
    ->select('*')
    ->from('pending_requests')
    ->compile();

$swek = $query->sql(); // SELECT "id" FROM "users" WHERE "id" = ?
$query->params(); // [5]

// Create query for db & fetch result

// Fetching pending requests, because the admin has to see the pending requests.

//$queryAll = "SELECT * FROM pending_requests";


$result = mysqli_query($db, $swek);


// Create array & store from the database

$pending_requests = [];

if($result) {

    while($row = mysqli_fetch_assoc($result)) {
        $pending_requests[] = $row;
    }

} else {
  print_r('murp');
}




// Close connection

mysqli_close($db);


?>
