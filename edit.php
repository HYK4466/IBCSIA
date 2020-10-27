<?php
session_start();
if (isset($_SESSION['id'])) {

  $uri = $_SERVER['REQUEST_URI'];
  $token = array("emptyfields", "unknownsport");


  if (strpos($uri, $token[0])) {
    echo "<script> alert('Fill in all the fields.'); </script>";
  }
  else if (strpos($uri, $token[1])) {
    echo "<script> alert('Unknown sport. Add it through Add Activity.'); </script>";
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
    <h1>Edit/Delete</h1>
    <form class="col-12" action="includes/edit.inc.php" method="post">
        <input autocomplete="off" id="sporttype" list="search" type="text" class="dropdown" name="sport" placeholder="Sports">
        <datalist id="search">
        </datalist>
        <input type="date" id="date" name="date" placeholder="Start Date">
        <input type="time" id="starttime" name="starttime" placeholder="xx:xx">
        <input type="time" id="stoptime" name="stoptime" placeholder="xx:xx">
        <br>
        <input autocomplete="off" list="search" type="text" class="dropdown" name="nsport" placeholder="Sports" required>
        <datalist id="search">
        </datalist>
        <input type="date" name="ndate" placeholder="Start Date" required>
        <input type="time" name="nstarttime" placeholder="xx:xx" required>
        <input type="time" name="nstoptime" placeholder="xx:xx" required>
        <input type="checkbox" id="ncheck" name="ncheck" value="true">
        <label for="ncheck">Done</label><br>
        <button type="submit" class="btn btn-primary" name="edit">Edit</button>
        <button type="submit" class="btn btn-secondary" name="delete">Delete</button>
    </form>
    <script type = "text/javascript" src="sport.js"></script>
    <script type = "text/javascript" src="cookieautofill.js"></script>


  </div>
</div>

</main>
</html>
