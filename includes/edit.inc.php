<?php

session_start();
if (isset($_SESSION['id'])) {}
else {
  header("Location: index.php?error=nosession");
  exit();
}

  if (isset($_POST['edit'])) {

    require 'dbh.inc.php';

    $sessionID = $_SESSION['id'];

    $sports = $_POST['sport'];
    $date = $_POST['date'];
    $starttime = $_POST['starttime'];
    $stoptime = $_POST['stoptime'];

    $nsports = $_POST['nsport'];
    $ndate = $_POST['ndate'];
    $nstarttime = $_POST['nstarttime'];
    $nstoptime = $_POST['nstoptime'];
    $ncheck = $_POST['ncheck'];

    if (empty($nsports) || empty($ndate) || empty($nstarttime) || empty($nstoptime) || empty($sports) || empty($date) || empty($starttime) || empty($stoptime) || empty($sessionID)) {
      header("Location: ../home.php?fieldincomplete");
      exit();
    }
    else {
      $sql = "SELECT sportsID FROM sports WHERE sportsName=?;";
      $pstmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($pstmt, $sql)) {
        header("Location: ../home.php?error=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($pstmt, "s", $nsports);
        mysqli_stmt_execute($pstmt);
        $result = mysqli_stmt_get_result($pstmt);
        $row = mysqli_fetch_assoc($result);

        //Update
        $sqlUpdate = "UPDATE exevents SET sportid=?, edate=?, startTime=?, stopTime=?, checkbox=? WHERE id=? AND edate=? AND startTime=? AND stopTime=?;";
        $ustmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($ustmt, $sqlUpdate)) {
          header("Location: ../home.php?error=sqlerror");
          exit();
        }
        else {
          $tempcheck = 0;
          if (!empty($ncheck)) {
            $tempcheck = 1;
          }
          mysqli_stmt_bind_param($ustmt, "isssiisss", $row['sportsID'], $ndate, $nstarttime, $nstoptime, $tempcheck,$sessionID, $date, $starttime, $stoptime);
          mysqli_stmt_execute($ustmt);
          header("Location: ../home.php?success=updated");
          exit();
        }

      }

    }
  }
  else if (isset($_POST['delete'])) {

    require 'dbh.inc.php';

    $sessionID = $_SESSION['id'];

    $sports = $_POST['sport'];
    $date = $_POST['date'];
    $starttime = $_POST['starttime'];
    $stoptime = $_POST['stoptime'];

    if (empty($sports) || empty($date) || empty($starttime) || empty($stoptime) ) {
      header("Location: ../home.php?emptyfields");
      exit();
    }
    else {
      $sql = "DELETE FROM exevents WHERE id=? AND edate=? AND startTime=? AND stopTime=?;";
      $pstmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($pstmt, $sql)) {
        header("Location: ../home.php?error=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($pstmt, "isss", $sessionID, $date, $starttime, $stoptime);
        mysqli_stmt_execute($pstmt);
        header("Location: ../home.php?success=deleted");
        exit();
      }
    }
  }
  else {
    header("Location: ../home.php");
    exit();
  }


 ?>
