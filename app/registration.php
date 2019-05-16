<?

include './includes/database.php';
require "../vendor/autoload.php";

use Respect\Validation\Validator as v;


// Validation

// GET user input


/////// GEBLEVEN BIJ. Hij doet het voor de Username, maar niet voor e-mail etc.

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
    $characterUser = v::alnum()->validate($username);
    $emptyUser = v::notBlank()->validate($username);


    // Email

    $noWhiteSpaceEmail = v::noWhitespace()->validate($email);
    $emptyEmail = v::optional(v::alpha())->validate($email);
    $characterEmail = v::alnum()->validate($email);
    $emailValidator = v::email()->validate(trim($email));




  // HIER GEBLEVEN CONDITIONALS DOEN T NIET GOED

    // Username conditional

    if(!$noWhiteSpaceUser) {
        array_push($errorUsername, "Geen witruimte toegestaan bij invullen gebruikersnaam");
    }

    if(!$characterUser) {
        array_push($errorUsername, "Only use character A-Z or 0-9");
    }

    if(!$emptyUser) {
        array_push($errorUsername, "Vul je gebruikersnaam in");
    }

    // Email conditional

    if(!$noWhiteSpaceEmail) {
        array_push($errorEmail, "Geen witruimte toegestaan bij invullen e-mail");
    }

}


?>


<!DOCTYPE html>
<html>

    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../app/dist/css/main.css">
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
