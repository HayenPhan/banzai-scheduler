<?php
    require_once '../../includes/database.php';

    // Start session because I need the first and Last name of employee.
    session_start();

    // The first and lastname of employee
    // By starting session, it knows who you are and for example also knows that your last_name is Phan.

    $first_name = $_SESSION['name'];
    $last_name = $_SESSION['last_name'];


    $db = mysqli_connect($host, $user, $password, $database)
    or die("Error: ". mysqli_connect_error());

    if (isset($_POST['request'])) {
        foreach($_POST['request'] as $key => $value) {
          $v = mysql_real_escape_string($_POST['request']);
          $sql = "INSERT INTO pending_requests (first_name, last_name, request)  /* Now all you have to add is the date and name and lastname */
          VALUES ('$first_name', '$last_name','$value')";
        }
    }


    if(mysqli_query($db, $sql)){
        echo "Requests inserted succesfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
    }



 ?>

 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="UTF-8">
     <title> Aanvragen gelukt </title>


 </head>
 <body>
     <div>
        <h1> Aanvragen is gelukt! Bedankt </h1>
      </div>

 </body>
 </html>
