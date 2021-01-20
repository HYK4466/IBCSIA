<?php

  if (isset($_POST['signup'])) {

    require 'dbh.inc.php';


    $email = $_POST['Email'];
    $username = $_POST['Username'];
    $password = $_POST['passwd'];
    $confirmPassword = $_POST['confirmPasswd'];
    $goal = $_POST['Mgoal'];
    $first = $_POST['first'];
    $last = $_POST['last'];

    if (empty($email) || empty($username) || empty($password) || empty($confirmPassword) || empty($goal) || empty($first) || empty($last)) {
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
    else if(preg_match("/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i", $first) || preg_match("/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i", $last)) {
      header("Location: ../signup.php?error=InvalidName");
      exit();
    }
    else if (strlen($password) < 8) {
      header("Location: ../signup.php?error=shortpassword");
      exit();
    }
    else if($password != $confirmPassword) {
      header("Location: ../signup.php?error=InvalidPasswordCheck&Username=".$username."&Email=".$email);
      exit();
    }
    else if ($goal > 31) {
      header("Location: ../signup.php?error=Morethan30daysgoal&Username=".$username."&Email=".$email);
      exit();
    }
    else {
      $sqlemail = "SELECT email FROM account WHERE email=?;";
      $istat = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($istat, $sqlemail)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($istat, "s", $email);
        mysqli_stmt_execute($istat);
        mysqli_stmt_store_result($istat);
        $resultcheck = mysqli_stmt_num_rows($istat);
        if ($resultcheck > 0) {
          header("Location: ../signup.php?error=emailtaken");
          exit();
        }
      }
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
          $sqlinsert = "INSERT INTO account (email, password, username, goals, resetHash, first, last) VALUES(?, ?, ?, ?, ?, ?, ?)";
          $insertstmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($insertstmt, $sqlinsert)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
          }
          else {
            $encryptPassword = password_hash($password, PASSWORD_DEFAULT);
            do {
              $code = randomString();
              $encryptHash = password_hash($code, PASSWORD_DEFAULT);
            } while (checkindatabase($encryptHash));
            session_start();
            $_SESSION['resetCode'] = $code;
            mysqli_stmt_bind_param($insertstmt, "sssisss", $email, $encryptPassword, $username, $goal, $encryptHash, $first, $last);
            mysqli_stmt_execute($insertstmt);
            header("Location: ../resetCode.php?signup=success");
            exit();
          }
        }
      }
    }

    mysqli_stmt_close($pstatement);
    mysqli_stmt_close($istat);
    mysqli_stmt_close($insertstmt);
    mysqli_close($conn);
  }
  else {
    header("Location: ../signup.php");
    exit();
  }

//check if $value is in database/account.
  function checkindatabase($value) {

    require 'dbh.inc.php';

    $sql = "SELECT * FROM account WHERE resetHash=?;";
    $pstmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($pstmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($pstmt, "s", $value);
      mysqli_stmt_execute($pstmt);

      $resultnum = mysqli_stmt_num_rows($pstmt);

      if ($resultnum > 0) {
        return true; // in database;
      }
      else {
        return false; //not in database;
      }
    }

    mysqli_stmt_close($pstmt);
    mysqli_close($conn);
  }

//create random string for reset code.
  function randomString() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random = "";

    for ($i = 0; $i < 60; $i++) {
      $index = rand(0, strlen($characters)-1); //61
      $random .= $characters[$index];
    }
    return $random;
  }
