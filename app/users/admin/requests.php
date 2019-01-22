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
    <link rel="stylesheet" type="text/css" href="../../../app/assets/styles/css/main.css">
</head>
<body>

  <div class="status__container">
     <div class="status__top">
         <div class="status__button-wrapper">
             <a class="status__button" href="requests.php" id="aanvraag">
                Aanvragen
             </a>
         </div>
         <div class="status__button-wrapper">
             <a class="current status__button" href="status.php" id="status">
               Status
             </a>
         </div>
         <a href="home.php" class="status__add">
             <div class="status__add-wrapper">
                 <img class="status__add-image" src="../../../app/assets/images/left-arrow.png" />
             </div>
         </a>
     </div>

       <?php foreach($pending_requests as $key => $items) { ?>

          <?=
              $status = '';

                if($items['status'] == 0) {
                    $status = '<p class="status__current-status pending"> In behandeling </p>';
                } else if($items['status'] == 1) {
                    $status = '<p class="status__current-status accepted"> Geaccepteerd </p>';
                } else if($items['status'] == 2) {
                    $status = '<p class="status__current-status rejected"> Geweigerd </p>';
                }
          ?>
                  <div class="status__long-square">
                      <p class="status__name"> <?= $items['first_name'] ?> </p>
                      <div class="status__content-wrapper">
                          <p class="status__default"> Aanvraag: </p>
                          <div class="status__request-wrapper">
                              <p class="status__request"><?= $items['request'] ?></p>
                              <p class="status__date"><?= $items['date'] ?></p>
                          </div>
                      </div>
                      <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
                          <input type="submit" name="rejected" value="Weigeren"> </input>
                          <input type="hidden"  name="id"  value="<?= $items['id'] ?>" />
                          <p> <?= $items['id']?></p>
                      </form>
                      <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
                          <input type="submit" name="accepted" value="Accepteren"> </input>
                          <input type="hidden"  name="id"  value="<?= $items['id'] ?>" />
                      </form>
                  </div>
       <?php }
       ?>
  </div>



</body>
</html>
