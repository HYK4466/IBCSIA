<?php

session_start();

if (isset($_POST['update'])) {

    require 'dbh.inc.php';

    $email = $_POST['Email'];
    $username = $_POST['Username'];
    $password = $_POST['passwd'];
    $confirmPassword = $_POST['confirmPasswd'];
    $goal = $_POST['Mgoal'];


    if (empty($email) && empty($username) && empty($password) && empty($confirmPassword) && empty($goal)) {
      // code for sending back
      header("Location: ../editProfile.php?error=emptyfields&Email=".$email."&Username=".$username);
      exit();
    }
    else if (empty($password) xor empty($confirmPassword)) {
      header("Location: ../editProfile.php?error=passwordnotretyped&Email=".$email."&Username=".$username);
      exit();
    }
    else if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
      header("Location: ../editProfile.php?error=InvalidEmail&Username=".$username);
      exit();
    }
    else if(!empty($username) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../editProfile.php?error=InvalidID&Email=".$email);
      exit();
    }
    else if (!(empty($password) || empty($confirmPassword)) && strlen($password) < 8) {
      header("Location: ../editProfile.php?error=shortpassword");
      exit();
    }
    else if(!(empty($password) || empty($confirmPassword)) && ($password != $confirmPassword)) {
      header("Location: ../editProfile.php?error=InvalidPasswordCheck&Username=".$username."&Email=".$email);
      exit();
    }
    else if (!empty($goal) && $goal > 31) {
      header("Location: ../editProfile.php?error=Morethan30daysgoal&Username=".$username."&Email=".$email);
      exit();
    }


    //update email
    if (!empty($email)) {
        $sqlusr = "SELECT username FROM account WHERE email=?;";
        $ustmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($ustmt, $sql)) {
          header("Location: ../home.php?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($ustmt, "s", $email);
          mysqli_stmt_execute($ustmt);
          mysqli_stmt_store_result($ustmt);
          $resultcheck = mysqli_stmt_num_rows($ustmt);
          if ($resultcheck > 0) {
            header("Location: ../editProfile.php?error=emailtaken");
            exit();
          }
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

        $sqlusr = "SELECT username FROM account WHERE username=?;";
        $ustmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($ustmt, $sql)) {
          header("Location: ../editProfile.php?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($ustmt, "s", $username);
          mysqli_stmt_execute($ustmt);
          mysqli_stmt_store_result($ustmt);
          $resultcheck = mysqli_stmt_num_rows($ustmt);
          if ($resultcheck > 0) {
            header("Location: ../editProfile.php?error=usrtaken&Email=".$email);
            exit();
          }
        }
        $sql = "UPDATE account SET username=? WHERE userID=?;";
        $pstmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($pstmt, $sql)) {
          header("Location: ../editProfile.php?error=sqlerror");
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
