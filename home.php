<?php
  session_start();
  // why does this work
  $cookie_number = 'id';
  $cookie_id = $_SESSION['id'];
  setcookie($cookie_number, $cookie_id, time() + 86400, "/");
  if (isset($_SESSION['id'])) {
    if (isset($_COOKIE[$cookie_number])) {

    }
    else {
      echo "<script>
        alert('Logged In');
        </script>";
    }
  }
  else {
    header("Location: index.php?error=nosession");
    exit();
  }

  require "includes/getCalEv.inc.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
    <link href='cal/main.css' rel='stylesheet'/>
    <script src='cal/main.js'></script>
    <title>Home Page</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <!--<form class="adding" action="AddInfo.php" method="post">
            <button type="submit" class="btn" name="add">Add</button>
          </form>-->
          <a class="nav-link" href="AddInfo.php">Add</a>
        </li>
        <li class="nav-item active">
          <!--<form class="editing" action="edit.php" method="post">
            <button type="submit" class="btn" name="edit">Edit</button>
          </form>-->
          <a class="nav-link" href="delete.php">Delete</a>
        </li>
        <li class="nav-item active">
          <!--<form class="editing" action="edit.php" method="post">
            <button type="submit" class="btn" name="edit">Edit</button>
          </form>-->
          <a class="nav-link" href="addActivity.php">Add Activity</a>
        </li>
        <li class="nav-item active">
          <!--<form class="editing" action="edit.php" method="post">
            <button type="submit" class="btn" name="edit">Edit</button>
          </form>-->
          <a class="nav-link" href="viewProfile.php">View Profile</a>
        </li>
        <li class="nav-item active">
          <!--<form class="editing" action="edit.php" method="post">
            <button type="submit" class="btn" name="edit">Edit</button>
          </form>-->
          <a class="nav-link" href="statistics.php">View Information</a>
        </li>
        <li class="nav-item active">
        <!--<form class="editing" action="includes/logout.inc.php" method="post">
            <button type="submit" class="btn" name="logout">Log Out</button>
          </form>-->

          <a class="nav-link" href="includes/logout.inc.php">Log Out</a>

        </li>
    </ul>
    </nav>

    <script type="text/javascript" src="calendar.js"></script>

    <div id='container'>
      <div id="goal">

      </div>
      <div id="calendar">
      </div>

      <div id="details" style="display: flex; justify-content: center; align-items: center;">
      </div>

    </div>



  </body>
</html>
