<?php
require_once '../../includes/database.php';

// Start session because I need the first and Last name of employee.
session_start();

$user_id = $_SESSION['id'];
$name = $_SESSION['name'];

// Create query for db & fetch result

// Fetching pending requests, because the admin has to see the pending requests.


$db = mysqli_connect($host, $user, $password, $database)
or die("Error: ". mysqli_connect_error());

$queryAll = "SELECT * FROM pending_requests WHERE status ='1'"; // fix this later, code still works


$result = mysqli_query($db, $queryAll);


// Create array

$details = [];

while($row = mysqli_fetch_assoc($result)) {
    $details[] = $row;
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Bekijk de status van je aanvragen </title>
    <link rel="stylesheet" type="text/css" href="../../../app/dist/css/main.css">
</head>
<body>

     <div class="requests-admin__top">

         <div class="requests-admin__button-wrapper">
             <a class="requests-admin__button" href="requests.php" id="aanvraag">
                Aanvragen
             </a>
         </div>
         <div class="requests-admin__button-wrapper">
             <a class="requests-admin__button" href="history.php" id="history">
                Geschiedenis
             </a>
         </div>

         <div class="requests-admin__button-wrapper">
             <a class="current requests-admin__button" href="overview.php" id="history">
                Overzicht
             </a>
         </div>

         <a href="home.php" class="requests-admin__add">
             <div class="requests-admin__add-wrapper">
                 <img class="requests-admin__add-image" src="../../../app/assets/images/left-arrow.png" />
             </div>
         </a>

         <div class="admin-requests-uitloggen__wrapper">
             <a class="admin-requests-uitloggen" href="../../logout.php">
                Uitloggen
             </a>
         </div>

     </div>


           <h2 class="overview__title"> Overzicht </h2>

       <?php foreach($details as $key => $items) { ?>

            <div class="overview__wrapper">

                  <div class="overview__container">
                      <p class="overview__name"> <?= $items['first_name'] ?> </p>
                      <p class="overview__request"> <?= $items['request'] ?> </p>
                      <p class="overview__date"> <?= $items['date'] ?> </p>
                  </div>

                  <div class="overview__edit-button">
                      <input class="overview__edit" type="submit" value="" name="rejected">
                      blub
                      </input>
                  </div>
            </div>

       <?php }
       ?>


</body>
</html>
