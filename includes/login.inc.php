<?php

if (isset($_POST['login'])) {

  require "dbh.inc.php";

  $email = $_POST['userID'];
  $password = $_POST['passwd'];

  if (empty($email) || empty($password)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
  }
  else {
    $sql = "SELECT * FROM account WHERE email=? OR username=?;";
    $pstmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($pstmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($pstmt, "ss", $email, $email);
      mysqli_stmt_execute($pstmt);

      $result = mysqli_stmt_get_result($pstmt);

      if ($row = mysqli_fetch_assoc($result)) {
        $pwdcheck = password_verify($password, $row['password']);
        if ($pwdcheck == false) {
          header("Location: ../index.php?error=wrong password");
          exit();
        }
        else if($pwdcheck == true) {
          session_start();
          $_SESSION['id'] = $row['userID'];
          $_SESSION['userName'] = $row['username'];

          header("Location: ../home.php?login=success");
          exit();
        }
        else {
          header("Location: ../index.php?error=pwderror");
          exit();
        }
      }
      else {
        header("Location: ../index.php?error=nouser");
        exit();
      }
    }

  }

}
else {
  header("Location: ../index.php");
  exit();
}
