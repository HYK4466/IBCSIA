<?php
  session_start();
  if (isset($_SESSION['id'])) {
    header("Location: home.php");
    exit();
  }
  else {

  $uri = $_SERVER['REQUEST_URI'];
  $token = array("success", "emptyfields", "shortpassword", "InvalidPasswordCheck");

  if (strpos($uri, $token[0])) {
    echo "<script> alert('RESET CODE success.'); </script>";
  }
  else if (strpos($uri, $token[1])) {
    echo "<script> alert('Empty Fields'); </script>";
  }
  else if (strpos($uri, $token[2])) {
    echo "<script> alert('Password has to be longer or equal to 8 characters.'); </script>";
  }
  else if (strpos($uri, $token[3])) {
    echo "<script> alert('Check your password and confirm password again.'); </script>";
  }

}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Change Password</title>

    <link rel="stylesheet" href="signin.css">
</head>

<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="align-items-center">
      <form class="col-12" action="includes/reset.inc.php" method="post">
        <img class="logo" src="logo.png" width="80px" height="80px">
        <div class="form-group">
        <input type="password" class="form-control" name="passwd" placeholder="Password" required>
        <input type="password" class="form-control" name="confirmPasswd" placeholder="Confirm Password" required>
      </div>
      <div>
        <button type="submit" class="btn btn-primary" name="change">Change</button>
      </div>
      </form>
  </div>
</div>
</div>
</body>
</html>
