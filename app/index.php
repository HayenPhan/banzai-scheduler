<?php

include './includes/database.php';
require "../vendor/autoload.php";

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

        include_once $_SERVER['DOCUMENT_ROOT'] . '/cle/banzai-scheduler/securimage/securimage.php';

        $securimage = new Securimage();


        // Username and password

        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $captchaCode = $_POST['captcha_code'];


        //PROBEER PDO TE GEBRUIKEN VOOR SQL INJECTIONS


        //$fetch = $db->prepare("SELECT * from users WHERE login_name = '$username' and password_hash = '$password' ");


        // Store Query in variable
        $usersQuery = "SELECT * from users WHERE login_name = '$username' and password_hash = '$password' ";

        // Run query with msql_queryy and check if it connects
        $result = mysqli_query($db, $usersQuery)
        or die("Failed to query".msqli_error());

        // fetch the results
        $row = mysqli_fetch_assoc($result);

        // U can do stricter checks, but for now we're just doing one simple error.

        /* if(empty($username) || empty($password )) {

            $error = v::numeric()->validate($username);

            $usernameValidator =  v::numeric();


        } */


        // Validation


        $errorUsername = v::optional(v::alpha())->validate($username);
        $errorPassword = v::optional(v::alpha())->validate($password);

        $noWhiteSpace = v::noWhitespace()->validate($username);
        $noWhiteSpace = v::noWhitespace()->validate($password);


        if($errorUsername || $errorPassword || $noWhiteSpace) {
            $error = "Gebruikersnaam of wachtwoord is onjuist";
        }



        // Check if name and password are in database

        if ($username == $row['login_name'] && $password == $row['password_hash'] && $securimage->check($_POST['captcha_code']) == true) {



          /*  // E-mail
            $_SESSION['type'] = $email; */

            // Nog van de opdracht
            $_SESSION['type'] = $row['user_type'];
            $_SESSION['name'] = $row['first_name'];
            $_SESSION['user_id'] = ((isset($row['user_id'])) ? ($row['user_id']) : '');


            if($_SESSION['type'] == 'admin') { // admin word straks een variable die je hebt geconnect met database.
              header("Location: ./users/admin/home.php");
              exit;

            } else if($_SESSION['type'] == 'employee') {
              header("Location: ./users/employee/home.php");
              exit;
            }


            }


            else if ($username != $row['login_name'] && $password != $row['password_hash'] && $securimage->check($_POST['captcha_code']) == false) {
                $error = "Combinatie gebruikersnaam/wachtwoord onjuist";
            }



    }

    // Am I loggin in? Please go to secure page

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../app/dist/css/main.css">
    </head>

    <body>

      <div class="login__container">

        <div class="login__left-square">
            <div class="login__logo-wrapper">
                <div class="login__logo">
                    <img class="login__logo-img" src="../app/assets/images/sumo.png" />
                </div>
                <div class="login__logo-white">
                    <img class="login__logo-white-img" src="../app/assets/images/sumo-white.png" />
                </div>
                <h2 class="login__logo-title"> Banzai </h2>
            </div>
        </div>

          <div class="login__right-square">
              <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
                  <div class="login__input-container">
                      <div class="login__input-wrapper">
                          <div class="login__input">
                              <input class="login__username" id="username" type="username" name="username" placeholder="Gebruikersnaam"/>
                          </div>
                          <div class="login__input">
                              <input class="login__password" id="password" type="password" name="password" placeholder="Wachtwoord"/>
                          </div>

                          <div class-"requests__captcha">

                              <img id="captcha" src="../securimage/securimage_show.php" alt="CAPTCHA Image" />

                              <div class="recaptcha">
                                  <input type="text" class="recaptcha__input" name="captcha_code"/>
                                  <br>
                                  <a href="#" class="recaptcha__link" onclick="document.getElementById('captcha').src = '../securimage/securimage_show.php?' + Math.random(); return false">
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
