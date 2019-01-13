<?php

session_start();

// May I even visit this page?

// If I don't have the login variable then.. i will redirect back to login page.
if($_SESSION['type'] =! 'employee') {
    header("Location: index.php");
    exit;
}

$name = $_SESSION['name'];

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../../../app/assets/styles/css/main.css">
    </head>

    <body>

      <div class="home__container">

        <div class="home__left-square">
            <div class="home__logo-wrapper">
                <div class="home__logo">
                    <img class="home__logo-img" src="../app/assets/images/sumo.png" />
                </div>
            </div>
        </div>

          <div class="home__right-square">

          </div>

      </div>

    </body>

</html>
