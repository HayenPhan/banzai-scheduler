<?php
    require_once '../../includes/database.php';

    // Start session because I need the first and Last name of employee.
    session_start();

    // The first and lastname of employee
    // By starting session, it knows who you are and for example also knows that your last_name is Phan.

    $first_name = $_SESSION['name'];



    if(isset($_POST['submit'])) {
        $msqli = mysqli_connect($host, $user, $password, $database)
        or die("Error: ". mysqli_connect_error());


        $request = $_POST['request'];


        if (isset($_POST['request'])) {

            // I've learned that you should always DEFINE your query and after that EXECECUTE it in your $result variable. Otherwise
            // it won't work.

            foreach($request as $key => $value) {

              $query = "SELECT id FROM pending_requests";

              $result = $msqli->query($query);


              if($result) {
                  //Perform inserted

                  //Msqli real escape string makes data safe before sending it to mysql.

                  $sql = "INSERT INTO pending_requests(first_name, request) VALUES ('$first_name','" . $msqli->real_escape_string($value) . "')";

                  $insert = $msqli->query($sql);

                  if (!$insert) {
                      echo $msqli->error;
                  } else {
                      print_r("Het is gelukt!");
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
     <title> Aanvragen gelukt </title>


 </head>
 <body>
     <div>
        <h1>  </h1>
      </div>

 </body>
 </html>
