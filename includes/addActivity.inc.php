<?php

session_start();
if (isset($_SESSION['id'])) {}
else {
  header("Location: index.php?error=nosession");
  exit();
}

if (isset($_POST['addActivity'])) {
  require 'dbh.inc.php';

  $activity = strtolower($_POST['activity']);

  if(empty($activity)){
    header("Location: ../AddActivity.php?error=emptyfields");
    exit();
  }
  else {
    $sqlsearch = "SELECT * FROM sports WHERE sportsName=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlsearch)) {
      die("Connection failed: ".mysqli_connect_error());
      header("Location: ../AddActivity.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $activity);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultrow = mysqli_stmt_num_rows($stmt);
      if ($resultrow > 0) {
        header("Location: ../AddActivity.php?exists");
        exit();
      }
    }

    $sqlinsert = "INSERT INTO sports (sportsName) VALUES (?);";
    $pstmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($pstmt, $sqlinsert)) {
      die("Connection failed: ".mysqli_connect_error());
      header("Location: ../AddInfo.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($pstmt, "s", $activity);
      mysqli_stmt_execute($pstmt);
      header("Location: ../home.php?success=addedActivity");
      exit();
    }
  }

}
else {
  header("Location: ../AddActivity.php");
  exit();
}

 ?>
