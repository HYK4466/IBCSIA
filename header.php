<?php
  session_start();
  if (isset($_SESSION['id'])) {
    header("Location: home.php");
    exit();
  }
  else {
    
  $uri = $_SERVER['REQUEST_URI'];
  $token1 = "wrongpassword";
  $token2 = "nouser";

  if (strpos($uri, $token1) || strpos($uri, $token2)) {
    echo "<script> alert('Check password and username again.'); </script>";
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
    <title>IB CS IA</title>

    <link rel="stylesheet" href="signin.css">
</head>

<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="align-items-center">
      <form class="col-12" action="includes/login.inc.php" method="post">
        <img class="logo" src="logo.png" width="80px" height="80px">
        <div class="form-group">
        <input type="text" class="form-control" name="userID" placeholder="Email or Username" required>
        <input type="password" class="form-control" name="passwd" placeholder="Password" required>
      </div>
      <div>
        <button type="submit" class="btn btn-primary" name="login">Sign In</button>
      </div>
      </form>
      <form class="col-12" action="signup.php" method="post">
        <button type="submit" class="btn btn-secondary" name="signup">Sign Up</button>
      </form>
  </div>
</div>
</div>
</body>
</html>
