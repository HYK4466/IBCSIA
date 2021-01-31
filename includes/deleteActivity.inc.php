<?php

session_start();
if (isset($_SESSION['id'])) {}
else {
  header("Location: index.php?error=nosession");
  exit();
}

if (isset($_POST['deleteActivity'])) {
  require 'dbh.inc.php';

  $activity = strtolower($_POST['activity']);

  if(empty($activity)){
    header("Location: ../deleteSport.php?error=emptyfields");
    exit();
  }
  else {
    $sqlsearch = "SELECT * FROM sports WHERE sportsName=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlsearch)) {
      die("Connection failed: ".mysqli_connect_error());
      header("Location: ../deleteSport.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $activity);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultrow = mysqli_stmt_num_rows($stmt);
      if ($resultrow > 0) {
        $sqldelete = "DELETE FROM sports WHERE sportsName=?;";
        $dstmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($dstmt, $sqldelete)) {
          die("Connection failed: ".mysqli_connect_error());
          header("Location: ../deteteSport.php?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($dstmt, "s", $activity);
          mysqli_stmt_execute($dstmt);
          header("Location: ../deleteSport.php?success");
          exit();
      }
    }
    else {
      header("Location: ../deleteSport.php?error=DNE");
      exit();
    }
  }

}
}
else {
  header("Location: ../deleteSport.php");
  exit();
}

 ?>
