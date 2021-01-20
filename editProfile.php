<?php
session_start();
if (isset($_SESSION['id'])) {
  $uri = $_SERVER['REQUEST_URI'];
  $token = array("usrtaken", "InvalidEmail", "InvalidID", "shortpassword", "InvalidPasswordCheck", "Morethan30daysgoal", "emailtaken", "passwordnotretyped", "emptyfields", "sqlerror", "emailtaken", "InvalidName");


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
    echo "<script> alert('Please check your password and confirm password'); </script>";
  }
  else if (strpos($uri, $token[8])) {
    echo "<script> alert('Fill in at least one field!'); </script>";
  }
  else if (strpos($uri, $token[9])) {
    echo "<script> alert('Technical error! Please try again.'); </script>";
  }
  else if (strpos($uri, $token[10])) {
    echo "<script> alert('Email already exists.'); </script>";
  }
  else if (strpos($uri, $token[11])) {
    echo "<script> alert('Invalid Names.'); </script>";
  }
}
else {
  header("Location: index.php?error=nosession");
  exit();
}



?>

<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src='https://code.jquery.com/jquery-3.4.1.min.js'></script>

  <title>Add</title>


</head>
<main>

  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <form class="adding" action="home.php" method="post">
        <button type="submit" class="btn" name="home">Home</button>
      </form>
    </li>
  </ul>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
    <h1>Update Profile</h1>
    <form name="updateform" class="col-12" action="includes/editProfile.inc.php" method="post">
        <input type="text" class="form-control" name="Email" placeholder="Email">
        <input type="text" class="form-control" name="Username" placeholder="Username">
        <input type="text" class="form-control" name="first" placeholder="First Name">
        <input type="text" class="form-control" name="last" placeholder="Last Name">
        <input type="password" class="form-control" name="passwd" placeholder="Password">
        <input type="password" class="form-control" name="confirmPasswd" placeholder="Confirm Password">
        <input type="text" class="form-control" name="Mgoal" placeholder="Monthly Goal (In days)">
        <!-- ADD MORE INPUTS -->
        <button type="submit" class="btn btn-primary" name="update">Update Profile</button>

    </form>

    <form name="updateform" class="col-12" action="confirm.php" method="post">
      <button type="submit" class="btn btn-primary" name="delete">Delete Account</button>
    </form>
  </div>
</div>

</main>
</html>
