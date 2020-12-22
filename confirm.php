<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location: index.php?error=nosession");
  exit();
}
else {
  $uri = $_SERVER['REQUEST_URI'];
  $token = array("nomatch");

  if (strpos($uri, $token[0])) {
    echo "<script> alert('The RESET CODE is incorrect!'); </script>";
  }
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
    <h1>Delete Account</h1>
    <form name="updateform" class="col-12" action="includes/editProfile.inc.php" method="post">
        <input type="password" class="form-control" id="reset" name="reset" placeholder="Reset Code" required>
        <input type="checkbox" onclick="reveal()">SHOW RESET CODE
        <script>
          function reveal() {
            var resetCode = document.getElementById("reset");
            if (resetCode.type == "password") {
              resetCode.type = "text";
            }
            else {
              resetCode.type = "password";
            }
          }
        </script>
        <!-- ADD MORE INPUTS -->
        <button type="submit" class="btn btn-primary" name="delete">Delete Account</button>
    </form>
  </div>
</div>

</main>
</html>
