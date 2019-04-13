<?

include './includes/database.php';
require "../vendor/autoload.php";

use Respect\Validation\Validator as v;


// Validation

// GET user input

$errorUsername = [];
$errorEmail = [];
$errorPassword = [];
$errorPasswordC = [];

  if (isset($_POST['submit'])) {

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];


// GET input array_count_value

    // All


    // Username

    $noWhiteSpaceUser = v::noWhitespace()->validate($username);
    $emptyUser = v::optional(v::alpha())->validate($username);
    $characterUser = v::alnum()->validate($username);

    // Email

    $noWhiteSpaceEmail = v::noWhitespace()->validate($email);
    $emptyEmail = v::optional(v::alpha())->validate($email);
    $characterEmail = v::alnum()->validate($email);
    $emailValidator = v::email()->validate(trim($email));


    // password

    $noWhiteSpacePassword = v::noWhitespace()->validate($password);
    $emptyPassword = v::optional(v::alpha())->validate($password);
    $characterPassword = v::alnum()->validate($password);

    // password confirm

    $noWhiteSpacePasswordC = v::noWhitespace()->validate($password_confirm);
    $emptyPasswordC = v::optional(v::alpha())->validate($password_confirm);
    $characterPasswordC = v::alnum()->validate($password_confirm);




  // HIER GEBLEVEN CONDITIONALS DOEN T NIET GOED

    // Username conditional

    if(!$noWhiteSpaceUser) {
        array_push($errorUsername, "Geen witruimte toegestaan bij invullen gebruikersnaam");
    }

    if(!$emptyUser) {
        array_push($errorUsername, "Gebruikersnaam is niet ingevuld");
    }

    if(!$characterUser) {
        array_push($errorUsername, "Alleen characters van A-Z en 0-9 zijn toegestaan");
    }

}


?>


<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../app/assets/styles/css/main.css">
    </head>

    <body>

      <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">

      <div class="control-group">
        <!-- Username -->
        <label class="control-label"  for="username">Username</label>
        <div class="controls">
          <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
        </div>



           <?php foreach($errorUsername as $key => $error) { ?>


                <p> <?= $error ?> </p>

           <?php }


           ?>




      </div>

      <div class="control-group">
        <!-- E-mail -->
        <label class="control-label" for="email">E-mail</label>
        <div class="controls">
          <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
        </div>

        <?php foreach($errorEmail as $key => $error) { ?>


             <p> <?= $error ?> </p>

        <?php }


        ?>

      </div>

      <div class="control-group">
        <!-- Password-->
        <label class="control-label" for="password">Password</label>
        <div class="controls">
          <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
        </div>

        <?php foreach($errorPassword as $key => $error) { ?>


             <p> <?= $error ?> </p>

        <?php }


        ?>

      </div>

      <div class="control-group">
        <!-- Password -->
        <label class="control-label"  for="password_confirm">Password (Confirm)</label>
        <div class="controls">
          <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
        </div>

        <?php foreach($errorPasswordC as $key => $error) { ?>


             <p> <?= $error ?> </p>

        <?php }


        ?>

      </div>

      <div class="control-group">
        <!-- Button -->
        <div class="controls">
          <button class="btn btn-success" type="submit" name="submit">Register</button>
        </div>

      </div>

      <p>

      </p>

  </form>

        </body>

</html>
