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

// JE ZIET NIKS OMDAT ER NOG GEEN GEACCEPTEERDE OF GEWEIGERDE REQUESTS ZIJN

// GET current status

// Revert as pending request

if(isset($_POST['revert'])) {

  $status = $_POST['status'];
  $currentId = $_POST['id'];

  if($status == 1 || $status == 2) {

    $revert = "UPDATE pending_requests SET status = '0' WHERE id = '$currentId'";
    $result = mysqli_query($db, $revert);

    if($result) {
        Header('Location: '.$_SERVER['PHP_SELF']);
        Exit();
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
    <title> Geschiedenis </title>

    <link rel="stylesheet" type="text/css" href="../../../app/dist/css/main.css">

</head>
<body>

  <div class="history__container">
     <div class="history__top">
         <div class="history__button-wrapper">
             <a class="history__button" href="requests.php" id="aanvraag">
                Requests
             </a>
         </div>
         <div class="history__button-wrapper">
             <a class="current history__button" href="history.php" id="history">
               History
             </a>
         </div>
         <div class="history__button-wrapper">
             <a class="history__button" href="overview.php" id="history">
               Overview
             </a>
         </div>
         <a href="home.php" class="history__add">
             <div class="history__add-wrapper">
                 <img class="history__add-image" src="../../../app/assets/images/left-arrow.png" />
             </div>
         </a>
         <div class="history-uitloggen__wrapper">
             <a class="history-uitloggen" href="../../logout.php" id="aanvraag">
                Uitloggen
             </a>
         </div>
     </div>

       <?php foreach($requests as $key => $items) { ?>

         <?php
             $status = '';

               if($items['status'] == 0) {
                   $status = '<p class="status__current-status pending"> Pending </p>';
               } else if($items['status'] == 1) {
                   $status = '<p class="status__current-status accepted"> Accepted </p>';
               } else if($items['status'] == 2) {
                   $status = '<p class="status__current-status rejected"> Rejected </p>';
               }
         ?>

                  <div class="history__long-square">
                      <p class="history__name"> <?= $items['first_name'] ?> </p>
                      <div class="history__content-wrapper">
                          <p class="history__default"> Request: </p>
                          <div class="history__request-wrapper">
                              <p class="history__request"><?= $items['request'] ?></p>
                              <p class="history__date"><?= $items['date'] ?></p>
                          </div>
                      </div>

                      <div class="history__status">
                        <?= $status ?>
                      </div>

                      <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
                          <input class="history__revert" type="submit" name="revert" value=""> </input>
                          <input type="hidden"  name="status"  value="<?= $items['status'] ?>" />
                          <input type="hidden"  name="id"  value="<?= $items['id'] ?>" />
                      </form>

                  </div>

       <?php } ?>

  </div>

</body>
</html>
