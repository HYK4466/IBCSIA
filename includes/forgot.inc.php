<?php
session_start();

if (isset($_POST['find'])) {

    require 'dbh.inc.php';

    $reset = $_POST['reset'];

    if (empty($reset)) {
      // code for sending back
      header("Location: ../forgot.php?error=enter_RESETCODE");
      exit();
    }
    //update email
    else {
        $sqlusr = "SELECT username, password FROM account WHERE email=?;";
        $ustmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($ustmt, $sql)) {
          header("Location: ../forgot.php?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($ustmt, "s", $email);
          mysqli_stmt_execute($ustmt);
          mysqli_stmt_store_result($ustmt);
          $result = mysqli_stmt_get_result($ustmt);
          $password = $result['password'];
          //CHANGE TO SENDINGE MAIL FOR RESETTING PASSWORD. GG
          $usrname = $result['username'];
          header("Location: ../forgot.php?username=".$usrname."password=".$password);
        }

        $sql = "UPDATE account SET email=? WHERE userID=?;";
        $pstmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($pstmt, $sql)) {
          header("Location: ../editProfile.php?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($pstmt, "si", $email, $_SESSION['id']);
          mysqli_stmt_execute($pstmt);
        }
    }
    //Update username
    if (!empty($username)) {
        $sqlusr = "SELECT email FROM account WHERE username=?;";
        $ustmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($ustmt, $sql)) {
          header("Location: ../forgot.php?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($ustmt, "s", $username);
          mysqli_stmt_execute($ustmt);
          mysqli_stmt_store_result($ustmt);
          $resultcheck = mysqli_stmt_num_rows($ustmt);
          if ($resultcheck > 0) {
            header("Location: ../forgot.php?error=usrtaken&Email=".$email);
            exit();
          }
        }
        $sql = "UPDATE account SET username=? WHERE userID=?;";
        $pstmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($pstmt, $sql)) {
          header("Location: ../forgot.php?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($pstmt, "si", $username, $_SESSION['id']);
          mysqli_stmt_execute($pstmt);

        }
      }


    if (!(empty($password) || empty($confirmPassword))) {


        $sql = "UPDATE account SET password=? WHERE userID=?;";
        $pstmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($pstmt, $sql)) {
          header("Location: ../editProfile.php?error=sqlerror");
          exit();
        }
        else {
          $encryptPassword = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($pstmt, "si", $encryptPassword, $_SESSION['id']);
          mysqli_stmt_execute($pstmt);
        }
      }

    if (!empty($goal)) {

        $sql = "UPDATE account SET goals=? WHERE userID=?;";
        $pstmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($pstmt, $sql)) {
          header("Location: ../editProfile.php?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($pstmt, "ii", $goal, $_SESSION['id']);
          mysqli_stmt_execute($pstmt);
        }
      }


    mysqli_stmt_close($pstatement);
    mysqli_stmt_close($ustmt);
    mysqli_close($conn);
    header("Location: ../home.php?success=updated");
    exit();
  }
  else {
    header("Location: ../home.php");
    exit();
  }
