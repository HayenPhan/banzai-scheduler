<?php

include './includes/database.php';

session_start();

// Create connection

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: ". mysqli_connect_error());

    // Check if user is logged in

    // Check if post isset

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Store Query in variable
        $usersQuery = "SELECT * from users WHERE login_name = '$username' and password_hash = '$password' ";

        // Run query with msql_queryy and check if it connects
        $result = mysqli_query($db, $usersQuery)
        or die("Failed to query".msqli_error());

        // fetch the results
        $row = mysqli_fetch_assoc($result);


        // U can do stricter checks, but for now we're just doing one simple error.

        if($username == "" || $password == "") {
            $error = "Vul beide gegevens in";
            print_r($error);

        // this is hardcoded, try to put database info in here next time.
        } else if ($username != $row['login_name'] || $password != $row['password_hash']) {
            $error = "Combinatie gebruikersnaam/wachtwoord onjuist";
            print_r($error);
        }
        // If there's no error than..
        // Put session_start above
        if(!isset($error)) {

          /*  // E-mail
            $_SESSION['type'] = $email; */

            // Nog van de opdracht
            $_SESSION['type'] = $row['user_type'];
            $_SESSION['name'] = $row['first_name'];

            if($_SESSION['type'] == 'admin') { // admin word straks een variable die je hebt geconnect met database.
              header("Location: ./users/admin/home.php");
              exit;

            } else if($_SESSION['type'] == 'employee') {
              header("Location: ./users/employee/home.php");
              exit;
            }

        }



    }

    // Am I loggin in? Please go to secure page




?>

<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../app/assets/styles/css/main.css">
    </head>

    <body>

      <div class="login__container">

          <div class="login__logo-wrapper">
              <div class="login__logo">
                  <img class="login__logo-img" src="../app/assets/images/sumo.png" />
              </div>
          </div>

          <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
              <div class="login__input-container">
                  <div class="login__input-wrapper">
                      <div class="login__input">
                          <input class="login__username" id="username" type="username" name="username" placeholder="Gebruikersnaam"/>
                      </div>
                      <div class="login__input">
                          <input class="login__password" id="password" type="password" name="password" placeholder="Wachtwoord"/>
                      </div>
                      <div class="login__input">
                          <button class="login__submit" type="submit" name="submit">
                              <h2> Login </h2>
                          </button>
                      </div>
                  </div>
              </div>
          </form>

      </div>

    </body>

</html>
