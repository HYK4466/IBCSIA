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
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.css" />
    <script src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>
    <script src="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.min.js"></script>
    <script src="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.min.js"></script>
    <script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js"></script>
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

    <div id="calendar" style="width: 80%;"><script type="text/javascript" src="calendar.js"></script></div>

  </body>
</html>
