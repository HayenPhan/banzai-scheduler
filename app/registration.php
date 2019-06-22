<?

include './includes/database.php';
require "../vendor/autoload.php";
require_once './includes/database.php';

use Respect\Validation\Validator as v;


// Validation

// GET user input


/////// GEBLEVEN BIJ. Hij doet het voor de Username, maar niet voor e-mail etc.

$errorUsername = [];
$errorEmail = [];
$errorPassword = [];
$errorPasswordC = [];
$errorFirstname = [];
$errorLastname = [];

  if (isset($_POST['submit'])) {

  $msqli = mysqli_connect($host, $user, $password, $database)
  or die("Error: ". mysqli_connect_error());

  $firstname = mysqli_real_escape_string($msqli, htmlentities($_POST['firstname']));
  $lastname = mysqli_real_escape_string($msqli, htmlentities($_POST['lastname']));
  $username = mysqli_real_escape_string($msqli, htmlentities($_POST['username']));
  $password = mysqli_real_escape_string($msqli, htmlentities($_POST['password']));



  $sql = "INSERT INTO users(login_name, password_hash, first_name, last_name, user_type)
  VALUES ('$username','$password','$firstname', '$lastname', 'employee')";

  $insert = $msqli->query($sql);

  if (!$insert) {
      echo $msqli->error;
  }



// GET input array_count_value

    // All


    // Username

    $noWhiteSpaceUser = v::noWhitespace()->validate($username);
    $characterUser = v::alnum()->validate($username);
    $emptyUser = v::notBlank()->validate($username);



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
          <!-- Password-->
          <label class="control-label" for="password">First name</label>
          <div class="controls">
            <input type="firstname" id="firstname" name="firstname" placeholder="" class="input-xlarge">
          </div>

          <?php foreach($errorFirstname as $key => $error) { ?>


               <p> <?= $error ?> </p>

          <?php }


          ?>

        </div>

        <div class="control-group">
          <!-- Password-->
          <label class="control-label" for="password">Last name</label>
          <div class="controls">
            <input type="lastname" id="lastname" name="lastname" placeholder="" class="input-xlarge">
          </div>

          <?php foreach($errorLastname as $key => $error) { ?>


               <p> <?= $error ?> </p>

          <?php }


          ?>

        </div>

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
