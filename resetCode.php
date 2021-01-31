<?php

  session_start();

  if (!isset($_SESSION['resetCode'])) {
      header("Location: index.php?error=notnew");
      exit();
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="signup.css">

  <title>RESET CODE</title>

  <style>
    .form-control {
      margin-left: 15%;
    }

    div {
      white-space: nowrap;
    }

    label {
      margin-left: 68%;
      margin-top: 10px;
    }
  </style>

</head>
        <main>
          <div class="container">
            <div class="row justify-content-center">
            <h1>IMPORTANT: SAVE THIS CODE. IT WILL BE USED TO RESET PASSWORD AND DELETE ACCOUNT.</h1>
            <form name="signupform" class="col-12">
                <br>
                <h5> <div>Reset Code: <input type="password" class="form-control" value=<?php echo $_SESSION['resetCode']; ?> id="reset" size="20" readonly></div><label> <input type="checkbox" onclick="reveal()">SHOW RESET CODE</label></h3>

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

              </form>

            <form action="index.php" method="post">
              <button type="submit" class="btn btn-secondary" name="signin">Sign In</button>
            </form>

          </div>
        </div>

        </main>

    </html>


  </body>
</html>

<?php

  unset($_SESSION['resetCode']);
  session_destroy();
 ?>
