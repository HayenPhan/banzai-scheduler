<?php
    require_once '../../includes/database.php';

    // Start session because I need the first and Last name of employee.
    session_start();

?>

 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="UTF-8">
     <title> Bekijk de status van je aanvragen </title>

     <link rel="stylesheet" type="text/css" href="../../../app/assets/styles/css/main.css">

 </head>
 <body>

   <div class="requests__top">
       <div class="requests__button-wrapper">
           <a class="requests__button" href="requests.php" id="aanvraag">
              Aanvragen
           </a>
       </div>
       <div class="requests__button-wrapper">
           <a class="current requests__button" href="status.php" id="status">
             Status
           </a>
       </div>
   </div>

   <h1> Bekijk de status van je aanvragen </h1>

   <ul>

     <?php foreach($pending_requests as $key => $items) { ?>

        <?=
            $status = '';

              if($items['status'] == 0) {
                  $status = 'In behandeling';
              } else if($items['status'] == 1) {
                  $status = 'Geaccepteerd';
              } else if($items['status'] == 2) {
                  $status = 'Geweigerd';
              }
        ?>
         <li>
             <p><?= $items['request'] ?></p>
             <p><?= $items['date'] ?></p>
              <p><?= $status ?></p>
         </li>
     <?php }
     ?>

   </ul>
 </body>
 </html>
