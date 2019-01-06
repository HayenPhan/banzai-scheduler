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


// Get current ID


// Update status to 1 (accepted)

if(isset($_POST['accepted'])) {
      $currentId = $_POST['id'];
      $acceptedQuery = "UPDATE pending_requests SET status = '1' WHERE id = '$currentId'";
      $result = mysqli_query($db, $acceptedQuery);

      if($result) {
          print_r('Het is gelukt');
      }else {
          print_r('Aanvraag accepteren is niet gelukt.');
      }

}


// Update status to 2 (rejected)

if(isset($_POST['rejected'])) {

      $currentId = $_POST['id'];
      $rejectedQuery = "UPDATE pending_requests SET status = '2' WHERE id = '$currentId'";
      $result = mysqli_query($db, $rejectedQuery);

      if($result) {
          print_r('Het is gelukt');
      }else {
          print_r('Aanvraag weigeren is niet gelukt.');
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
  <h1> Bekijk de status van je aanvragen </h1>

  <ul>

    <?php foreach($pending_requests as $key => $items) { ?>
        <li>
            <p><?= $items['first_name'] ?></p>
            <p><?= $items['request'] ?></p>
            <p><?= $items['date'] ?></p>
            <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
                <input type="submit" name="rejected" value="Weigeren"> </input>
                <input type="hidden"  name="id"  value="<?= $items['id'] ?>" />
                <p> <?= $items['id']?></p>
            </form>
            <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
                <input type="submit" name="accepted" value="Accepteren"> </input>
                <input type="hidden"  name="id"  value="<?= $items['id'] ?>" />
            </form>
        </li>
    <?php }
    ?>

  </ul>
</body>
</html>
