<?php
require_once '../../includes/database.php';


$db = mysqli_connect($host, $user, $password, $database)
or die("Error: ". mysqli_connect_error());

if(isset($_POST['insertdata'])) {

    $id = $_POST['id'];

    $request = $_POST['request'];

    $request_date = $_POST['date'];

    $query = "UPDATE pending_requests SET date='$request_date', request='$request' WHERE id='$id'";
    $result = mysqli_query($db, $query);

    if($result) {
      header("location:overview.php");
    } else {
      print_r("Update failed");
    }
}

?>
