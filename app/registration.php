<?

include './includes/database.php';
require "../vendor/autoload.php";
require_once './includes/database.php';


if (isset($_POST['submit'])) {


// Mysql connection
$msqli = mysqli_connect($host, $user, $password, $database)
or die("Error: ". mysqli_connect_error());

  if(!empty($_POST)) {
      // GET POST
      $firstname = mysqli_real_escape_string($msqli, htmlspecialchars($_POST['firstname']));
      $lastname = mysqli_real_escape_string($msqli, htmlspecialchars($_POST['lastname']));
      $username = mysqli_real_escape_string($msqli, htmlspecialchars($_POST['username']));
      $password = mysqli_real_escape_string($msqli, htmlspecialchars($_POST['password']));
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);

      // Validation

      $firstnamelen = strlen($firstname);
      $lastnamelen = strlen($lastname);
      $usernamelen = strlen($username);
      $passwordlen = strlen($password);
      $max = 255;
      $minfirstname = 2;
      $minlastname = 2;
      $minusername = 6;
      $minpassword = 12;

      // Errors
      $errors = [];

      // First name
      if($firstnamelen < $minfirstname){
          $errors[] = "Name must be at least 2 characters";
      } elseif($firstnamelen > $max){
          $errors[] = "Name must be less than 255 characters";
      }

      // Last name
      if($lastnamelen < $minlastname){
          $errors[] = "Last name must be at least 2 characters";
      } elseif($lastnamelen > $max){
          $errors[] = "Last name must be less than 255 characters";
      }

      // User name
      if($usernamelen < $minusername){
          $errors[] = "Username must be at least 6 characters";
      } elseif($usernamelen > $max){
          $errors[] = "Username must be less than 255 characters";
      }

      // Password
      if($passwordlen < $minpassword){
          $errors[] = "Password must be at least 12 characters";
      } elseif($passwordlen > $max){
          $errors[] = "Password must be less than 255 characters";
      }


      // Insert into database
      $sql = "INSERT INTO users(login_name, password_hash, first_name, last_name, user_type)
      VALUES ('$username','$passwordHash','$firstname', '$lastname', 'employee')";

      $insert = $msqli->query($sql);

      if (!$insert) {
          echo $msqli->error;
      }
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

        </div>

        <div class="control-group">
          <!-- Password-->
          <label class="control-label" for="password">Last name</label>
          <div class="controls">
            <input type="lastname" id="lastname" name="lastname" placeholder="" class="input-xlarge">
          </div>

        </div>

      <div class="control-group">
        <!-- Username -->
        <label class="control-label"  for="username">Username</label>
        <div class="controls">
          <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
        </div>

      </div>



      <div class="control-group">
        <!-- Password-->
        <label class="control-label" for="password">Password</label>
        <div class="controls">
          <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
        </div>

      </div>

      <div class="control-group">
        <!-- Button -->
        <div class="controls">
          <button class="btn btn-success" type="submit" name="submit">Register</button>
        </div>

      </div>

        <?php

          if(isset($errors)){
            foreach($errors as $error) {
              echo "<p> $error </p>";
            }
          }

        ?>

  </form>


        </body>

</html>
