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
                    <img class="home__logo-img" src="../../../app/assets/images/sumo.png" />
                </div>
            </div>
            <div class="home__title-wrapper">
                <h2 class="home__title"> Welkom, <br> <?= $name ?> </h2>
            </div>
        </div>

          <div class="home__right-square">
              <div class="home__overview-title-wrapper">
                  <h2 class="home__overview-title"> Overzicht vakantie dagen </h2>
              </div>

              <div class="home__overview-wrapper">
                  <div class="home__date-wrapper">
                      <p> 30 </p>
                      <p> Dec </p>
                  </div>
                  <div class="home__request-wrapper">
                      <p> 18:00 </p>
                      <p> Kerstdiner op school </p>
                  </div>
              </div>

              <div class="home__overview-wrapper">
                  <div class="home__date-wrapper">
                      <p> 30 </p>
                      <p> Dec </p>
                  </div>
                  <div class="home__request-wrapper">
                      <p> 18:00 </p>
                      <p> Kerstdiner op school </p>
                  </div>
              </div>

              <div class="home__link-wrapper">
                  <p> Bekijk alles </p>
              </div>

              <div class="home__icons">
                  <div> icon 1 </div>
                  <div> icon 2 </div>
              </div>

          </div>

      </div>

    </body>

</html>
