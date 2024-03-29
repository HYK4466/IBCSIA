<?php
session_start();

if (isset($_SESSION['id'])) {
  header("Location: index.php");
  exit();
}

$uri = $_SERVER['REQUEST_URI'];
$token = array("enter_RESETCODE", "InvalidEmail", "sqlerror", "failed", "emailnotfound");

if (strpos($uri, $token[0])) {
  echo "<script> alert('Your input fields are not completely filled in.'); </script>";
}

else if (strpos($uri, $token[1])) {
  echo "<script> alert('Invalid email address.'); </script>";
}

else if (strpos($uri, $token[2])) {
  echo "<script> alert('Technical error! Try again later.'); </script>";
}

else if (strpos($uri, $token[3])) {
  echo "<script> alert('Reset Code is incorrect. Failed!'); </script>";
}

else if (strpos($uri, $token[4])) {
  echo "<script> alert('Email not found!'); </script>";
}

?>

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="forgot.css">

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

</head>
        <main>

          <div class="container">
            <div class="row justify-content-center">
            <h1>Forgot Password</h1>
            <form name="signupform" class="col-12" action="includes/forgot.inc.php" method="post">
                <input type="text" class="form-control" name="email" placeholder="Email" required>
                <input type="password" class="form-control" id="reset" name="reset" placeholder="Reset Code" size="20" required>
                <p class="form-control"><input type="checkbox" onclick="reveal()"> SHOW RESET CODE</p>
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
                <button type="submit" class="btn btn-primary" name="find">Reset my password</button>
            </form>

            <form action="index.php" method="post">
              <button type="submit" class="btn btn-secondary" name="signin">Sign In</button>
            </form>
          </div>
        </div>
        </main>
    </html>

<?php
  require "footer.php";
?>
