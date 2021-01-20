<?php

session_start();
require 'dbh.inc.php';

if (isset($_POST['update'])) {

    $email = $_POST['Email'];
    $username = $_POST['Username'];
    $password = $_POST['passwd'];
    $confirmPassword = $_POST['confirmPasswd'];
    $goal = $_POST['Mgoal'];
    $first = $_POST['first'];
    $last = $_POST['last'];


    if (empty($email) && empty($username) && empty($password) && empty($confirmPassword) && empty($goal) && empty($first) && empty($last)) {
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
    else if(preg_match("/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i", $first) || preg_match("/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i", $last)) {
      header("Location: ../editProfile.php?error=InvalidName");
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
        if (!mysqli_stmt_prepare($ustmt, $sqlusr)) {
          header("Location: ../editProfile.php?error=sqlerror");
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

      if (!empty($first)) {

          $sql = "UPDATE account SET first=? WHERE userID=?;";
          $pstmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($pstmt, $sql)) {
            header("Location: ../editProfile.php?error=sqlerror");
            exit();
          }
          else {
            mysqli_stmt_bind_param($pstmt, "si", $first, $_SESSION['id']);
            mysqli_stmt_execute($pstmt);
          }
        }

        if (!empty($last)) {

            $sql = "UPDATE account SET last=? WHERE userID=?;";
            $pstmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($pstmt, $sql)) {
              header("Location: ../editProfile.php?error=sqlerror");
              exit();
            }
            else {
              mysqli_stmt_bind_param($pstmt, "si", $last, $_SESSION['id']);
              mysqli_stmt_execute($pstmt);
            }
          }


    mysqli_stmt_close($pstatement);
    mysqli_stmt_close($ustmt);
    mysqli_close($conn);
    header("Location: ../home.php?success=updated");
    exit();
  }
  else if (isset($_POST['delete'])) {

    $resetCode = $_POST['reset'];

    if (empty($resetCode)) {
      header("Location: ../confirm.php?error=emptyfields&Email=".$resetCode);
      exit();
    }

    $ssql = "SELECT resetHash FROM account WHERE userID =?;"; // change to resetcode
    $dstmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($dstmt, $ssql)) {
      header("Location: ../editProfile.php?error=sqlerror");
      exit();
    }
    else {

      mysqli_stmt_bind_param($dstmt, "i", $_SESSION['id']);
      mysqli_stmt_execute($dstmt);

      $result = mysqli_stmt_get_result($dstmt);

      if ($row = mysqli_fetch_assoc($result)) {
        $check = password_verify($resetCode, $row['resetHash']);
        if ($check == false) {
          header("Location: ../confirm.php?error=nomatch");
          exit();
        }
        else{
          $dsql = "DELETE FROM account WHERE userID=?;"; // change to resetcode
          $cstmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($cstmt, $dsql)) {
            header("Location: ../editProfile.php?error=sqlerror");
            exit();
          }
          else {
            mysqli_stmt_bind_param($cstmt, "i", $_SESSION['id']);
            mysqli_stmt_execute($cstmt);
            session_unset();
            session_destroy();
            header("Location: ../index.php?success=Deleted");
            exit();
          }
        }
      }
    }
    mysqli_stmt_close($dstmt);
    mysqli_close($conn);
  }
  else {
    header("Location: ../home.php");
    exit();
  }
