<?

//include './../includes/database.php';
//require "../vendor/autoload.php";
require_once './../../includes/database.php';


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
      $minusername = 3;
      $minpassword = 3;

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
        <link rel="stylesheet" type="text/css" href="./../../dist/css/main.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    </head>

    <body>

      <div class="form__wrapper">
      <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">

        <p class="form__title"> Register new employee </p>

        <div class="form-group">
          <!-- Password-->
          <label class="control-label" for="password">First name</label>
          <div class="controls">
            <input type="text" id="firstname" name="firstname" placeholder="" class="form-control">
          </div>

        </div>

        <div class="form-group">
          <!-- Last name -->
          <label class="control-label" for="password">Last name</label>
            <input type="text" id="lastname" name="lastname" placeholder="" class="form-control">
        </div>

      <div class="form-group">
        <!-- Username -->
        <label class="control-label"  for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="" class="form-control">
      </div>



      <div class="form-group">
        <!-- Password-->
        <label class="control-label" for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="" class="form-control">
      </div>

        <!-- Button -->
          <button class="btn btn-primary form__button" type="submit" name="submit">Register</button>


        <?php

          if(isset($errors)){
            foreach($errors as $error) {
              echo "<p> $error </p>";
            }
          }

        ?>

  </form>
</div>

        </body>

</html>
