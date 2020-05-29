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

// Check if edit button has been clicked


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Bekijk de status van je aanvragen </title>
    <link rel="stylesheet" type="text/css" href="../../../app/dist/css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
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


                <!--- 1. When clicked on button it has to add new inputs with the above text als placeholder, but
                ONLY in the request div that you're on, all the other requests should NOT be changed.-->

                  <div  id="overview_button" class="overview__edit-button">
                      <input id="edit_request" class="overview__edit view_data" type="submit" value="" name="edit">
                      </input>
                  </div>


            </div>

       <?php }
       ?>

</body>
</html>

<div id="dataModal" class="modal fade">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title">Employee Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body" id="employee_detail">
                 <p> test </p>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
          </div>
     </div>
</div>

<script>
  $(document).ready(function() {
      $('.view_data').click(function() {
          $('#dataModal').modal("show")
      });
  });
</script>
