<?php

  require "dbh.inc.php";

  session_start();

  $totalgoal = 0;

  $sql = "SELECT goals FROM account WHERE userID=?;";
  $pstmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($pstmt, $sql)) {
    header("Location: ../index.php?error=sqlerror");
    exit();
  }
  else {
    mysqli_stmt_bind_param($pstmt, "i", $_SESSION['id']);
    mysqli_stmt_execute($pstmt);
    $result = mysqli_stmt_get_result($pstmt);
    $row = mysqli_fetch_assoc($result);
    $totalgoal = $row['goals'];
  }

  $sql = "SELECT goals FROM account WHERE userID=?;";

  if (!mysqli_stmt_prepare($pstmt, $sql)) {
    header("Location: ../index.php?error=sqlerror");
    exit();
  }
  else {
    mysqli_stmt_bind_param($pstmt, "i", $_SESSION['id']);
    mysqli_stmt_execute($pstmt);
    $result = mysqli_stmt_get_result($pstmt);
    $row = mysqli_fetch_assoc($result);
    $totalgoal = $row['goals'];
    echo $totalgoal;
  }




 ?>
