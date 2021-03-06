<?php

include 'app/includes/database.php';
require "vendor/autoload.php";

use Respect\Validation\Validator as v;



session_start();

// Create connection

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: ". mysqli_connect_error());

    // Check if user is logged in

    // Check if post isset

        // Always start with an empty error first
        $error = "";

        if (isset($_POST['submit'])) {


        // Insert phpcaptcha

        include_once $_SERVER['DOCUMENT_ROOT'].'/banzai-scheduler/securimage/securimage.php';

        $securimage = new Securimage();


        // Username and password

        $username = mysqli_real_escape_string($db, htmlspecialchars($_POST['username']));
        $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));
        $captchaCode = $_POST['captcha_code'];

        // Store Query in variable
        $usersQuery = "SELECT * from users WHERE login_name = '$username'";

        // Run query with msql_queryy and check if it connects
        $result = mysqli_query($db, $usersQuery)
        or die("Failed to query".msqli_error());


        $row = mysqli_fetch_assoc($result);

        // Validation


        $errorUsername = v::optional(v::alpha())->validate($username);
        $errorPassword = v::optional(v::alpha())->validate($password);

        $noWhiteSpace = v::noWhitespace()->validate($username);
        $noWhiteSpace = v::noWhitespace()->validate($password);


          // Check if name and password are in database

          if ($username == $row['login_name'] && password_verify($password, $row['password_hash']) && $securimage->check($_POST['captcha_code']) == true) {

          /*  // E-mail
            $_SESSION['type'] = $email; */

            // Nog van de opdracht
            $_SESSION['type'] = $row['user_type'];
            $_SESSION['name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['id'] = ((isset($row['id'])) ? ($row['id']) : '');


            if($_SESSION['type'] == 'admin') { // admin word straks een variable die je hebt geconnect met database.
              header("Location: app/users/admin/home.php");
              exit;

            } else if($_SESSION['type'] == 'employee') {
              header("Location: app/users/employee/home.php");
              exit;
            }

            }

            else {
                $error = "Username or password is not correct";

            }

  }

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="app/dist/css/main.css">
    </head>

    <body>

      <div class="login__container">

        <div class="login__left-square">
            <div class="login__logo-wrapper">
                <div class="login__logo">
                    <img class="login__logo-img" src="app/assets/images/sumo.png" />
                </div>
                <div class="login__logo-white">
                    <img class="login__logo-white-img" src="app/assets/images/sumo-white.png" />
                </div>
                <h2 class="login__logo-title"> Banzai </h2>
            </div>
        </div>

          <div class="login__right-square">
              <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
                  <div class="login__input-container">
                      <div class="login__input-wrapper">
                          <div class="login__input">
                              <input class="login__username" id="username" type="username" name="username" placeholder="Username"/>
                          </div>
                          <div class="login__input">
                              <input class="login__password" id="password" type="password" name="password" placeholder="Password"/>
                          </div>

                          <div class-"requests__captcha">

                              <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />

                              <div class="recaptcha">
                                  <input type="text" class="recaptcha__input" name="captcha_code"/>
                                  <br>
                                  <a href="#" class="recaptcha__link" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">
                                  [ Different Image ]
                                  </a>
                              </div>
                          </div>

                          <div class="login__input">
                              <button class="login__submit" type="submit" name="submit">
                                  <h2 class="login__submit-title"> Login </h2>
                              </button>
                          </div>

                          <div class="login__error-wrapper">
                            <p class="login__error"><?= $error ?></p>
                          </div>



                      </div>
                  </div>
              </form>
          </div>

      </div>

    </body>

</html>
