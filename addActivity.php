<?php
session_start();
if (isset($_SESSION['id'])) {
  $uri = $_SERVER['REQUEST_URI'];
  $token = array("emptyfields", "sqlerror", "exists");


  if (strpos($uri, $token[0])) {
    echo "<script> alert('Fill in all the fields'); </script>";
  }
  else if (strpos($uri, $token[1])) {
    echo "<script> alert('Technical Error. Try again later.'); </script>";
  }
  else if (strpos($uri, $token[2])) {
    echo "<script> alert('The activity already exists.'); </script>";
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

  <title>Add Activities</title>

  <style>
  .form-control {
    width: 30%;
    margin-left: 390;
    margin-top: 10;
  }

  .btn-primary {
    margin-left: 505;
    margin-top: 10;
  }

  </style>

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
    <h1>Add Activity</h1>
    <form class="col-12" action="includes/addActivity.inc.php" method="post">
        <input autocomplete="off" id="activity" class="form-control" name="activity" placeholder="Activity" required>
        <button type="submit" class="btn btn-primary" name="addActivity">Add Activity</button>
    </form>

  </div>
</div>

</main>
</html>
