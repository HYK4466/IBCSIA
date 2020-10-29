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
  $starttime = $_POST['starttime'];
  $stoptime = $_POST['stoptime'];

  if(empty($sport) || empty($date) || empty($starttime) || empty($stoptime)){
    header("Location: ../AddInfo.php?error=emptyfields&sport=".$sport."&date=".$date."&starttime=".$starttime."&stoptime=".$stoptime);
    exit();
  }
  else {
    $sqlsearch = "SELECT * FROM exevents WHERE startTime=? AND stopTime = ? AND edate=?;";
    $pstmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($pstmt, $sqlsearch)) {
      header("Location: ../AddInfo.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($pstmt, "sss", $starttime, $stoptime, $date);
      mysqli_stmt_execute($pstmt);
      mysqli_stmt_store_result($pstmt);
      $resultrow = mysqli_stmt_num_rows($pstmt);
      if ($resultrow > 0) {
        header("Location: ../AddInfo.php?scheduleconflict");
        exit();
      }
    }

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
        $sqlinsert = "INSERT INTO exevents (id, sportid, edate, startTime, stopTime) VALUES (?, ?, ?, ?, ?);";
        $rstmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($rstmt, $sqlinsert)) {
          die("Connection failed: ".mysqli_connect_error());
          header("Location: ../AddInfo.php?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($rstmt, "iisss", $_SESSION['id'], $row['sportsID'], $date, $starttime, $stoptime);
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
