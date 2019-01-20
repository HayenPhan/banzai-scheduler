<?php
    require_once '../../includes/database.php';

    // Start session because I need the first and Last name of employee.
    session_start();

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
   </div>

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
        <ul>
             <li class="status__list-item">
                <div>
                 <p><?= $items['request'] ?></p>
                 <p><?= $items['date'] ?></p>
                  <p><?= $status ?></p>
                </div>
             </li>
        </ul>
     <?php }
     ?>

   </ul>
</div>

 </body>
 </html>
