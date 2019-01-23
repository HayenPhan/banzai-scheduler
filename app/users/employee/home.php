<?php

session_start();

// May I even visit this page?

// If I don't have the login variable then.. i will redirect back to login page.
if($_SESSION['type'] =! 'employee') {
    header("Location: index.php");
    exit;
} else {
    $name = $_SESSION['name'];
}

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

            <div class="uitloggen__wrapper">
                <a class="uitloggen" href="../../logout.php" id="aanvraag">
                   Uitloggen
                </a>
            </div>

              <div class="home__overview">

                  <div class="home__overview-title-wrapper">
                      <h2 class="home__overview-title"> Overzicht vakantie dagen </h2>
                  </div>

                  <div class="home__overview-wrapper">
                      <div class="home__date-wrapper">
                          <p class="home__day"> 30 </p>
                          <p class="home__month"> Dec </p>
                      </div>
                      <div class="home__request-wrapper">
                          <p class="home__time"> 18:00 </p>
                          <p class="home__request"> Kerstdiner op school </p>
                      </div>
                  </div>

                  <div class="home__overview-wrapper">
                      <div class="home__date-wrapper">
                          <p class="home__day"> 30 </p>
                          <p class="home__month"> Dec </p>
                      </div>
                      <div class="home__request-wrapper">
                          <p class="home__time"> 18:00 </p>
                          <p class="home__request"> Kerstdiner op school </p>
                      </div>
                  </div>

                  <div class="home__link-wrapper">
                      <p class="home__link"> Bekijk alles </p>
                  </div>

                  <div class="home__bottom">
                      <hr class="home__line" />

                      <div class="home__icons-wrapper">
                          <a href="home.php">
                              <div class="home__icon-wrapper-one">
                                  <img class="home__icon" src="../../../app/assets/images/huisje.png" />
                              </div>
                          </a>

                          <a href="requests.php">
                              <div class="home__icon-wrapper-two">
                                  <img class="home__icon" src="../../../app/assets/images/agenda.png" />
                              </div>
                          </a>
                      </div>
                  </div>


              </div>

          </div>

      </div>

    </body>

</html>
