<?php
session_start();
if (isset($_SESSION['id'])) {

  $uri = $_SERVER['REQUEST_URI'];
  $token = array("emptyfields", "unknownsport", "startbigstop");


  if (strpos($uri, $token[0])) {
    echo "<script> alert('Fill in all the fields.'); </script>";
  }
  else if (strpos($uri, $token[1])) {
    echo "<script> alert('Unknown sport. Add it through Add Activity.'); </script>";
  }
  else if (strpos($uri, $token[2])) {
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

  <title>Edit Activity</title>
  <style>
  .form-control {
    width: 30%;
    margin-left: 380;
    margin-top: 10;
  }

  .btn-primary {
    margin-left: 510;
  }

  .btn-secondary {
    margin-left: 500;
    margin-top: 10;
  }

  .check {
    margin-left: 390;
  }

  .copy {
    margin-left: -30;
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
    <h1>Edit/Delete</h1>
    <form class="col-12" action="includes/edit.inc.php" method="post">
        <input autocomplete="off" id="sporttype" list="search" type="text" class="dropdown form-control" name="sport" placeholder="Sports" readonly>
        <datalist id="search">
        </datalist>
        <input type="date" id="date" name="date" class = "form-control" placeholder="Start Date" readonly>
        <input type="time" id="starttime" name="starttime" class="form-control" placeholder="xx:xx" readonly>
        <input type="time" id="stoptime" name="stoptime" class="form-control" placeholder="xx:xx" readonly>

        <br>
        <input autocomplete="off" id="nsporttype" list="search" type="text" class="dropdown form-control" name="nsport" placeholder="Sports" required>
        <datalist id="search">
        </datalist>
        <input type="date" id="ndate" name="ndate" class="form-control"  placeholder="Start Date" required>
        <input type="time" id="nstarttime"name="nstarttime" class="form-control" placeholder="xx:xx" required>
        <input type="time" id="nstoptime" name="nstoptime" class="form-control" placeholder="xx:xx" required>
        <input type="checkbox" id="ncheck" class="check" name="ncheck" value="true" >
        <label for="ncheck">Done</label><br>
        <button type="submit" class="btn btn-primary" name="edit">Edit</button>
        <br>
        <button type="submit" class="btn btn-secondary" name="delete">Delete</button>
    </form>
    <button onclick="copy()" style="margin-top: 10;"class="btn btn-primary copy">Copy</button>
    <script>
      function copy() {
        document.getElementById("nsporttype").value = document.getElementById("sporttype").value;
        document.getElementById("ndate").value = document.getElementById("date").value;
        document.getElementById("nstarttime").value = document.getElementById("starttime").value;
        document.getElementById("nstoptime").value = document.getElementById("stoptime").value;
      }
    </script>
    <script type = "text/javascript" src="sport.js"></script>
    <script type = "text/javascript" src="cookieautofill.js"></script>


  </div>
</div>

</main>
</html>
