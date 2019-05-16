<?php

session_start();

require_once '../../includes/database.php';



// May I even visit this page?

// If I don't have the login variable then.. i will redirect back to login page.
if($_SESSION['type'] != 'admin') {
    header("Location: index.php");
    exit;
}

$name = $_SESSION['name'];

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: ". mysqli_connect_error());

$queryAll = "SELECT * FROM pending_requests WHERE status ='1'"; // fix this later, code still works


$result = mysqli_query($db, $queryAll);


// Create array

$details = [];

while($row = mysqli_fetch_assoc($result)) {
    $details[] = $row;
}


?>


<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../../../app/dist/css/main.css">
    </head>

    <body>

      <div class="home__container">

        <div class="home__left-square">
            <div class="home__logo-wrapper">
                <div class="home__logo">
                    <img class="home__logo-img" src="../../../app/assets/images/sumo.png" />
                </div>
                <div class="home__logo-white">
                    <img class="home__logo-white-img" src="../../../app/assets/images/sumo-white.png" />
                </div>
            </div>
            <div class="home__title-wrapper">
                <h2 class="home__title"> Welkom, <br> <?= $name ?> </h2>
            </div>
        </div>

          <div class="home__right-square">

            <div class="uitloggen__wrapper">
                <a class="uitloggen" href="../../logout.php">
                   Uitloggen
                </a>
            </div>

              <div class="home__overview">
                  <div class="home__overview-title-wrapper">
                      <h2 class="home__overview-title"> Overzicht vakantie dagen </h2>
                  </div>


                 <?php foreach(array_slice($details, 0, 3) as $key => $items) { ?>

                  <div class="home__overview-wrapper">
                      <div class="home__date-wrapper">
                          <p class="home__day"> 30 </p>
                          <p class="home__month"> Dec </p>
                      </div>
                      <div class="home__request-wrapper">
                          <p class="home__request"> <?= $items['request'] ?> </p>
                      </div>
                  </div>

                <?php } ?>

                  <div class="home__link-wrapper">
                      <a class="home__link-link home__link" href="overview.php">
                           Bekijk alles
                      </a>
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
