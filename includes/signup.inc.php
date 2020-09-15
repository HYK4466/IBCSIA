<?php

  if (isset($_POST['signup'])) {

    require 'dbh.inc.php';

    $email = $_POST['Email'];
    $username = $_POST['Username'];
    $password = $_POST['passwd'];
    $confirmPassword = $_POST['confirmPasswd'];

    if (empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
      // code for sending back
      header("Location: ../signup.php?error=emptyfields&Email=".$email."&Username=".$username);
      exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../signup.php?error=InvalidEmailUID");
      exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../signup.php?error=InvalidEmail&Username=".$username);
      exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../signup.php?error=InvalidID&Email=".$email);
      exit();
    }
    else if($password != $confirmPassword) {
      header("Location: ../signup.php?error=InvalidPasswordCheck&Username=".$username."&Email=".$email);
      exit();
    }
    else {
      $sql = "SELECT username FROM account WHERE username=?;";
      $pstatement = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($pstatement, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($pstatement, "s", $username);
        mysqli_stmt_execute($pstatement);
        mysqli_stmt_store_result($pstatement);
        $resultcheck = mysqli_stmt_num_rows($pstatement);
        if ($resultcheck > 0) {
          header("Location: ../signup.php?error=usrtaken&Email=".$email);
          exit();
        }
        else {
          $sqlinsert = "INSERT INTO account (email, password, username) VALUES(?, ?, ?)";
          $insertstmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($insertstmt, $sqlinsert)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
          }
          else {
            $encryptPassword = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($insertstmt, "sss", $email, $encryptPassword, $username);
            mysqli_stmt_execute($insertstmt);
            header("Location: ../home.php?signup=success");
            exit();
          }
        }
      }

    }

    mysqli_stmt_close($pstatement);
    mysqli_stmt_close($insertstmt);
    mysqli_close($conn);
  }
  else {
    header("Location: ../signup.php");
    exit();
  }
