<?php
    require_once '../../includes/database.php';

    // Start session because I need the first and Last name of employee.
    session_start();

    // The first and lastname of employee
    // By starting session, it knows who you are and for example also knows that your last_name is Phan.

    $first_name = $_SESSION['name'];
    $last_name = $_SESSION['last_name'];
    $user_id = $_SESSION['id'];

    if(isset($_POST['submit'])) {

        $msqli = mysqli_connect($host, $user, $password, $database)
        or die("Error: ". mysqli_connect_error());

        $request = $_POST['request'];
        $date = $_POST['date'];


        if (isset($_POST['request'])) {

            // I've learned that you should always DEFINE your query and after that EXECECUTE it in your $result variable. Otherwise
            // it won't work.

            foreach($request as $key => $value) {

              $query = "SELECT id FROM pending_requests";

              $result = $msqli->query($query);



              foreach($date as $key => $valuedate) {

                  if($result) {
                      //Perform inserted

                      //Msqli real escape string makes data safe before sending it to mysql.

                      $sql = "INSERT INTO pending_requests(first_name, last_name, user_id, request, date) VALUES ('$first_name','$last_name','$user_id','" . $msqli->real_escape_string($value) . "', '$valuedate')";

                      $insert = $msqli->query($sql);

                      if (!$insert) {
                          echo $msqli->error;
                      }
                  }

              }

            }

        }

        // Close

        mysqli_close($msqli); //

    }



 ?>

 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="UTF-8">
     <title> Success </title>

     <link rel="stylesheet" type="text/css" href="../../../app/dist/css/main.css">


 </head>
 <body>

   <div class="requests__container">
   <div class="requests__top">
       <div class="requests__button-wrapper">
           <a class="current requests__button" href="requests.php" id="aanvraag">
              Requests
           </a>
       </div>
       <div class="requests__button-wrapper">
           <a href="status.php" id="status" class="requests__button">
             Status
           </a>
       </div>
       <div class="requests__button-wrapper">
           <a href="overview.php" id="status" class="requests__button">
             Overview
           </a>
       </div>
       <a href="home.php" class="status__add">
           <div class="status__add-wrapper">
               <img class="status__add-image" src="../../../app/assets/images/left-arrow.png" />
           </div>
       </a>
       <div class="requests-uitloggen__wrapper">
           <a class="requests-uitloggen" href="../../logout.php">
              Log out
           </a>
       </div>
   </div>
         <div class="requests__succes">
            <h2 class="requests__succes-title"> Your request is successfully submitted  </h2>
          </div>
    </div>
 </body>
 </html>
