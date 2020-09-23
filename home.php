<?php
  session_start();
  if (isset($_SESSION['id'])) {
    echo "<script>
      alert('Logged In');
    </script>";
  }
  else {
    header("Location: index.php?error=nosession");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Home Page</title>
  </head>

  <body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <form class="adding" action="AddInfo.php" method="post">
            <button type="submit" class="btn" name="add">Add</button>
          </form>
        </li>
      </ul>
    </nav>

    <div id="calendar">
      <script type="text/javascript" src="calendar.js"></script>
    </div>

  </body>
</html>
