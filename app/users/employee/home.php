<?php



session_start();

require_once '../../includes/database.php';


// Current time API

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'http://worldtimeapi.org/api/ip');
$result = curl_exec($ch);
curl_close($ch);

$time = json_decode($result);

$timezone = $time->timezone;
$week_number = $time->week_number;
$datetime = $time->utc_datetime;
$datetimesinglebyte = substr($datetime, 0, 10);






// May I even visit this page?

// If I don't have the login variable then.. i will redirect back to login page.
if($_SESSION['type'] =! 'employee') {
    header("Location: index.php");
    exit;
} else {
    $name = $_SESSION['name'];
}

$user_id = $_SESSION['id'];
$name =  htmlspecialchars($_SESSION['name']);

// Create query for db & fetch result

// Fetching pending requests, because the admin has to see the pending requests.


$db = mysqli_connect($host, $user, $password, $database)
or die("Error: ". mysqli_connect_error());

$queryAll =

 "SELECT pending_requests.request, pending_requests.date, pending_requests.status, pending_requests.first_name
 FROM pending_requests
 INNER JOIN users ON pending_requests.user_id = users.id
 WHERE pending_requests.user_id = $user_id AND pending_requests.status = 1"; // fix this later, code still works


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
                <a class="uitloggen" href="../../logout.php" id="aanvraag">
                   Uitloggen
                </a>
            </div>

              <div class="home__overview">


                  <div class="home__overview-title-wrapper">
                      <h2 class="home__overview-title"> Overzicht vakantie dagen </h2>
                  </div>


                   <?php foreach(array_slice($details, 0, 3) as $key => $items) { ?>

                     <?php
                          $date = $items['date'];
                          $day = date("d",strtotime($date));
                          $month = date("F",strtotime($date));
                     ?>

                      <div class="home__overview-wrapper">
                          <div class="home__date-wrapper">
                              <p class="home__day"> <?= $day ?>  </p>
                              <p class="home__month"> <?= $month ?> </p>
                          </div>
                          <div class="home__request-wrapper">
                              <p class="home__request"> <?= $items['first_name'] ?> </p>
                              <p class="home__request"> <?= $items['request'] ?> </p>
                          </div>
                      </div>

                <?php }
                ?>

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


                  <div class="home__currenttime-wrapper">

                      <p class="home__currenttime-text"> Je bent momenteel in <?= $timezone ?></p>
                      <p class="home__currenttime-text"> De datum van vandaag is: <?= $datetimesinglebyte ?>, week <?= $week_number ?>! </p>


                  </div>



              </div>

          </div>

      </div>

    </body>

</html>
