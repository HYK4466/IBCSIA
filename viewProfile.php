<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src='https://code.jquery.com/jquery-3.4.1.min.js'></script>

  <title>View Profile</title>


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
    <h1>Your Profile</h1>
        <table class="table" id="profile">

        </table>

        <script type="text/javascript" src="profile.js"></script>
    <form name="updateform" class="col-12" action="editProfile.php" method="post">
      <button type="submit" class="btn btn-primary" name="delete">Edit Account</button>
    </form>
    <form name="updateform" class="col-12" action="confirm.php" method="post">
      <button type="submit" class="btn btn-primary" name="delete">Delete Account</button>
    </form>

  </div>
</div>

</main>
</html>
