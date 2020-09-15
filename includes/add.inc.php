<?php

if (isset($_POST['add'])) {
  require 'dbh.inc.php';

  $sport = $_POST['sport'];
  $date = $_POST['date'];

  if(empty($sport) || empty($date)){
    header("Location: ../AddInfo.php?error=emptyfields&sport=".$sport."&date=".$date);
    exit();
  }
  else {
    $sqlinsert = "INSERT INTO ";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../AddInfo.php?error=sqlerror");
      exit();
    }
    else {
      $
    }
  }

}
else {
  header("Location: ../AddInfo.php");
  exit();
}
