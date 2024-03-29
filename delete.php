<?php
session_start();
if (isset($_SESSION['id'])) {
  $uri = $_SERVER['REQUEST_URI'];
  $token = array("emptyfields", "sqlerror", "DNE");


  if (strpos($uri, $token[0])) {
    echo "<script> alert('Fill in all the fields'); </script>";
  }
  else if (strpos($uri, $token[1])) {
    echo "<script> alert('Technical Error. Try again later.'); </script>";
  }
  else if (strpos($uri, $token[2])) {
    echo "<script> alert('The event does not exist.'); </script>";
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

  <title>Delete</title>
  <style>
  .form-control {
    width: 30%;
    margin-left: 390;
    margin-top: 10;
  }

  .btn-primary {
    margin-left: 525;
    margin-top: 10;
  }

  .btn-secondary {
    margin-left: -30%;
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
    <h1>Delete</h1>
    <form class="col-12" action="includes/edit.inc.php" method="post">
        <input autocomplete="off" id="sporttype" list="search" type="text" class="dropdown form-control" name="sport" placeholder="Sports">
        <datalist id="search">
          <script type = "text/javascript" src="sport.js"></script>
        </datalist>
        <input type="date" id="date" list="datedropdown" class="form-control" name="date" placeholder="Start Date">
        <datalist id="datedropdown"></datalist>
        <input type="time" id="starttime" class="form-control" name="starttime" placeholder="xx:xx">
        <input type="time" id="stoptime" class="form-control" name="stoptime" placeholder="xx:xx">
        <button type="submit" class="btn btn-primary" name="delete">Delete</button>
        <script type="text/javascript" src="datedropdown.js"></script>

    </form>


  </div>
</div>

</main>
</html>
