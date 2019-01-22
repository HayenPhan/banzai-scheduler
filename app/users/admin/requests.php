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
        Header('Location: '.$_SERVER['PHP_SELF']);
        Exit();
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
          Header('Location: '.$_SERVER['PHP_SELF']);
          Exit();
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

  <div class="requests-admin__container">
     <div class="requests-admin__top">
         <div class="requests-admin__button-wrapper">
             <a class="current requests-admin__button" href="requests.php" id="aanvraag">
                Aanvragen
             </a>
         </div>
         <div class="requests-admin__button-wrapper">
             <a class="requests-admin__button" href="history.php" id="history">
               History
             </a>
         </div>
         <a href="home.php" class="requests-admin__add">
             <div class="requests-admin__add-wrapper">
                 <img class="requests-admin__add-image" src="../../../app/assets/images/left-arrow.png" />
             </div>
         </a>
     </div>

       <?php foreach($pending_requests as $key => $items) { ?>

                  <div class="requests-admin__long-square">
                      <p class="requests-admin__name"> <?= $items['first_name'] ?> </p>
                      <div class="requests-admin__content-wrapper">
                          <p class="requests-admin__default"> Aanvraag: </p>
                          <div class="requests-admin__request-wrapper">
                              <p class="requests-admin__request"><?= $items['request'] ?></p>
                              <p class="requests-admin__date"><?= $items['date'] ?></p>
                          </div>
                      </div>
                      <div class="requests-admin__buttons-wrapper">
                          <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
                              <input class="requests-admin__rejected" type="submit" value="" name="rejected">
                              </input>
                              <input type="hidden"  name="id"  value="<?= $items['id'] ?>" />
                          </form>
                          <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
                              <input class="requests-admin__accepted" type="submit" value="" name="accepted">
                              </input>
                              <input type="hidden"  name="id"  value="<?= $items['id'] ?>" />
                          </form>
                    </div>
                  </div>


       <?php }
       ?>
  </div>


</body>
</html>
