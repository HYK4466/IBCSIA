<?php

require 'dbh.inc.php';

if (isset($_POST['find'])) {


    $reset = $_POST['reset'];
    $email = $_POST['email'];

    if (empty($reset) || empty($email)) {
      // code for sending back
      header("Location: ../forgot.php?error=enter_RESETCODE");
      exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../forgot.php?error=InvalidEmail");
      exit();
    }
    //find
    else {
        $sql = "SELECT resetHash FROM account WHERE email=?;";
        $ustmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($ustmt, $sql)) {
          header("Location: ../forgot.php?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($ustmt, "s", $email);
          mysqli_stmt_execute($ustmt);
          $result = mysqli_stmt_get_result($ustmt);
          if ($row = mysqli_fetch_assoc($result)) {
            $hashCheck = password_verify($reset, $row['resetHash']);
            if ($hashCheck) {
              session_start();
              $_SESSION['email'] = $email;
              header("Location: ../resetPassword.php?resetCode=success");
              exit();
            }
            else {
              header("Location: ../forgot.php?resetCode=failed");
              exit();
            }
          }
          else {
            header("Location: ../forgot.php?emailnotfound");
            exit();
          }
        }
    }

    mysqli_stmt_close($ustmt);
    mysqli_close($conn);
    exit();
  }
  else {
    header("Location: ../home.php");
    exit();
  }
