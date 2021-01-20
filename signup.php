<?php

$uri = $_SERVER['REQUEST_URI'];
$token = array("usrtaken", "InvalidEmail", "InvalidID", "shortpassword", "InvalidPasswordCheck", "Morethan30daysgoal", "emailtaken", "InvalidName");


if (strpos($uri, $token[0])) {
  echo "<script> alert('Username already taken.'); </script>";
}
else if (strpos($uri, $token[1])) {
  echo "<script> alert('Email Invalid.'); </script>";
}
else if (strpos($uri, $token[2])) {
  echo "<script> alert('Invalid Username.'); </script>";
}
else if (strpos($uri, $token[3])) {
  echo "<script> alert('Password must be at least 8 characters long.'); </script>";
}
else if (strpos($uri, $token[4])) {
  echo "<script> alert('The confirmation password does not match.'); </script>";
}
else if (strpos($uri, $token[5])) {
  echo "<script> alert('Goal cannot exceed 30 days.'); </script>";
}
else if (strpos($uri, $token[6])) {
  echo "<script> alert('Email Taken.'); </script>";
}
else if (strpos($uri, $token[7])) {
  echo "<script> alert('Invalid Names.'); </script>";
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="signup.css">

  <title>Sign Up</title>

</head>
        <main>

          <div class="container">
            <div class="row justify-content-center">
            <h1>Sign Up</h1>
            <form name="signupform" class="col-12" action="includes/signup.inc.php" method="post">
                <input type="text" class="form-control" name="Email" placeholder="Email" required>
                <input type="text" class="form-control" name="Username" placeholder="Username" required>
                <input type="text" class="form-control" name="first" placeholder="First Name" required>
                <input type="text" class="form-control" name="last" placeholder="Last Name" required>
                <input type="password" class="form-control" name="passwd" placeholder="Password" required>
                <input type="password" class="form-control" name="confirmPasswd" placeholder="Confirm Password" required>
                <input type="text" class="form-control" name="Mgoal" placeholder="Monthly Goal (In days)" required>
                <!-- ADD MORE INPUTS -->
                <button type="submit" class="btn btn-primary" name="signup">Sign Up</button>
            </form>

            <form action="index.php" method="post">
              <button type="submit" class="btn btn-secondary" name="signin">Sign In</button>
            </form>

          </div>
        </div>

        </main>

    </html>

<?php
  require "footer.php";
?>
