<?php

session_start();
if (isset($_SESSION['id'])) {}
else {
  header("Location: index.php?error=nosession");
  exit();
}


if (isset($_POST['add'])) {
  require 'dbh.inc.php';

  $sport = $_POST['sport'];
  $date = $_POST['date'];

  if(empty($sport) || empty($date)){
    header("Location: ../AddInfo.php?error=emptyfields&sport=".$sport."&date=".$date);
    exit();
  }
  else {
    $sqlselect = "SELECT sportsID FROM sports WHERE sportsName = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlselect)) {
      header("Location: ../AddInfo.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $sport);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {
        $sqlinsert = "INSERT INTO exevents (id, sportid, edate) VALUES (?, ?, ?);";
        $rstmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($rstmt, $sqlinsert)) {
          die("Connection failed: ".mysqli_connect_error());
          header("Location: ../AddInfo.php?error=sql");
          exit();
        }
        else {
          mysqli_stmt_bind_param($rstmt, "iis", $_SESSION['id'], $row['sportsID'], $date);
          mysqli_stmt_execute($rstmt);
          header("Location: ../home.php?success=added");
          exit();
        }
      }
    }
  }

}
else {
  header("Location: ../AddInfo.php");
  exit();
}
