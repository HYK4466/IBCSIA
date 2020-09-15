<?php
session_start();
if (isset($_SESSION['id'])) {}
else {
  header("Location: index.php?error=nosession");
  exit();
}
?>
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <title>Add</title>
</head>
<main>

  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
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
    <form class="col-12" action="includes/add.inc.php" method="post">
        <input list="sports" type="text" class="dropdown" name="sport" placeholder="Sports">
        <datalist id="sports">
          <script type = "text/javascript" src="sport.js"></script>
        </datalist>
        <input type="date" name="date" placeholder="Date">
        <button type="submit" class="btn btn-primary" name="add">Add</button>
    </form>

  </div>
</div>

</main>
</html>