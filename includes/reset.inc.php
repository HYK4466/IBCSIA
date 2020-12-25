<?php

session_start();
require 'dbh.inc.php';

if (isset($_POST['change'])) {

    $password = $_POST['passwd'];
    $confirmPassword = $_POST['confirmPasswd'];

    if (empty($password) || empty($confirmPassword)) {
      // code for sending back
      header("Location: ../resetPassword.php?error=emptyfields");
      exit();
    }
    else if (!(empty($password) || empty($confirmPassword)) && strlen($password) < 8) {
      header("Location: ../resetPassword.php?error=shortpassword");
      exit();
    }
    else if(!(empty($password) || empty($confirmPassword)) && ($password != $confirmPassword)) {
      header("Location: ../resetPassword.php?error=InvalidPasswordCheck");
      exit();
    }
    //update email
    else {
        $sql = "UPDATE account SET password=? WHERE email=?;";
        $ustmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($ustmt, $sql)) {
          header("Location: ../resetPassword.php?error=sqlerror");
          exit();
        }
        else {
          $encryptedPass = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($ustmt, "ss", $encryptedPass, $_SESSION['email']);
          mysqli_stmt_execute($ustmt);
        }
    }

    mysqli_stmt_close($ustmt);
    mysqli_close($conn);
    header("Location: ../index.php?success=updated");
    exit();
  }
  else {
    header("Location: ../index.php");
    exit();
  }
