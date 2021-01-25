<?php
session_start();
if (isset($_SESSION['id'])) {

  $uri = $_SERVER['REQUEST_URI'];
  $token = array("emptyfields", "sqlerror", "scheduleconflict", "startbigstop");


  if (strpos($uri, $token[0])) {
    echo "<script> alert('Fill in all the fields'); </script>";
  }
  else if (strpos($uri, $token[1])) {
    echo "<script> alert('Technical Error. Try again later.'); </script>";
  }
  else if (strpos($uri, $token[2])) {
    echo "<script> alert('The time is already taken.'); </script>";
  }
  else if (strpos($uri, $token[3])) {
    echo "<script> alert('Start time has to be a previous time than Stop time.'); </script>";
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
    <h1>Add</h1>
    <form class="col-12" action="includes/add.inc.php" id="exInputs" method="post">
        <input autocomplete="off" list="search" type="text" class="dropdown" name="sport" placeholder="Sports">
        <datalist id="search">
          <script type = "text/javascript" src="sport.js"></script>
        </datalist>
        <input type="date" name="date" placeholder="Start Date">
        <input type="time" name="starttime" placeholder="xx:xx">
        <input type="time" name="stoptime" placeholder="xx:xx">
        <button type="submit" class="btn btn-primary" name="add">Add</button>
    </form>
    <button type="submit" onclick='autofill()' class='btn btn-secondary'> Use Frequently Choosed Options</button>

  </div>
</div>

<script type="text/javascript" src="frequentAutoFill.js"></script>


</main>
</html>
