<?php
require_once '../../includes/database.php';

// Start session because I need the first and Last name of employee.
session_start();

// Create connection

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: ". mysqli_connect_error());

$queryAll = "SELECT * FROM pending_requests WHERE status ='1' OR status ='2' "; // fix this later, code still works

$result = mysqli_query($db, $queryAll);


// Create array & store from the database

$requests = [];

while($row = mysqli_fetch_assoc($result)) {
    $requests[] = $row;
}

// Normal fetch

$request = mysqli_fetch_assoc($result);

// GET current status

// Revert as pending request

if(isset($_POST['revert'])) {

  $status = $_POST['status'];
  $currentId = $_POST['id'];

  if($status == 1 || $status == 2) {

    $revert = "UPDATE pending_requests SET status = '0' WHERE id = '$currentId'";
    $result = mysqli_query($db, $revert);

    if($result) {
        print_r('Het is met succes teruggezet bij pending requests.');
    }else {
        print_r('Het is niet gelukt met het terugzetten naar pending requests.');
    }

  } else if($status == !1 || $status == !2) {
      print_r('nondejuuu');
  }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Bekijk de status van je aanvragen </title>

</head>
<body>
  <h1> Geschiedenis aanvragen </h1>

  <ul>

    <?php foreach($requests as $key => $items) { ?>
        <li>
            <p><?= $items['first_name'] ?></p>
            <p><?= $items['request'] ?></p>
            <p><?= $items['date'] ?></p>
            <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
                <input type="submit" name="revert" value="revert"> </input>
                <input type="hidden"  name="status"  value="<?= $items['status'] ?>" />
                <input type="hidden"  name="id"  value="<?= $items['id'] ?>" />
            </form>
        </li>
    <?php }
    ?>

  </ul>
</body>
</html>
