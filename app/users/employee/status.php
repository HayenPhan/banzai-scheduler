<?php
    require_once '../../includes/database.php';

    // Start session because I need the first and Last name of employee.
    session_start();

    $user_id = $_SESSION['user_id'];

    // Create query for db & fetch result

    // Fetching pending requests, because the admin has to see the pending requests.


    $db = mysqli_connect($host, $user, $password, $database)
    or die("Error: ". mysqli_connect_error());

    $queryAll =

     "SELECT pending_requests.request, pending_requests.date
     FROM pending_requests
     INNER JOIN users ON pending_requests.user_id = users.user_id
     WHERE pending_requests.user_id = $user_id;"; // fix this later, code still works


    $newresult = mysqli_query($db, $queryAll);


    // Create array & store from the database

    $lol = [];

    while($row = mysqli_fetch_assoc($newresult)) {
        $lol[] = $row;
    }

    print_r($lol)


?>

 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="UTF-8">

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
                    <p class="status__name">Xiaotong</p>
                    <div class="status__content-wrapper">
                        <p class="status__default"> Aanvraag: </p>
                        <div class="status__request-wrapper">
                            <p class="status__request"><?= $items['request'] ?></p>
                            <p class="status__date"><?= $items['date'] ?></p>
                        </div>
                    </div>
                    <?= $status ?>
                </div>
     <?php }
     ?>
</div>

 </body>
 </html>
