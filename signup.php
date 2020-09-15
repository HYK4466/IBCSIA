<!--<?php
  require "header.php";
?> -->

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="signup.css">
</head>
        <main>

          <div class="container">
            <div class="row justify-content-center">
            <h1>Sign Up</h1>
            <form class="col-12" action="includes/signup.inc.php" method="post">
                <input type="text" class="form-control" name="Email" placeholder="Email">
                <input type="text" class="form-control" name="Username" placeholder="Username">
                <input type="password" class="form-control" name="passwd" placeholder="Password">
                <input type="password" class="form-control" name="confirmPasswd" placeholder="Confirm Password">
                <!-- ADD MORE INPUTS -->
                <button type="submit" class="btn btn-primary" name="signup">Sign Up</button>
            </form>

            <form action="index.php" method="post">
              <button type="submit" class="btn btn-secondary" name="signin">Sign In</button>
            </form>

          </div>
        </div>

        </main>

<?php
  require "footer.php";
?>