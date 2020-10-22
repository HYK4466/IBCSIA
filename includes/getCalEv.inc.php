<?php

//Fullcalendar display events;

session_start();

require "dbh.inc.php";

$response = array();
$sql = "SELECT * FROM exevents WHERE id = ?;";
$pstmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($pstmt, $sql)) {
  header("Location: ../index.php?error=sqlerror");
  exit();
}
else {
  mysqli_stmt_bind_param($pstmt, "i", $_SESSION['id']);
  mysqli_stmt_execute($pstmt);
  $result = mysqli_stmt_get_result($pstmt);
  $a = array();


  $jsonfile = fopen("../getevent.json", "w");

  while($row = mysqli_fetch_assoc($result)) {
      $stime = strtotime($row['edate']);
      $stringDate = date('Y-m-d', $stime);
      $sttime = strtotime($row['edate']);
      $stringsDate = date('Y-m-d', $sttime);

      $sqlSport = "SELECT sportsName FROM sports WHERE sportsID = ?;";
      if (!mysqli_stmt_prepare($pstmt, $sqlSport)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
      }
      else {
        mysqli_stmt_bind_param($pstmt, "i", $row['sportid']);
        mysqli_stmt_execute($pstmt);
        $resultName = mysqli_stmt_get_result($pstmt);
        if ($rowResult = mysqli_fetch_assoc($resultName)) {
          array_push($a, array('title' => $rowResult['sportsName'], 'start' => $stringDate, 'stop' => $stringsDate, 'id' => $row["id"], 'sTime' => $row['startTime'], 'stTime' => $row['stopTime'], 'checkbox' => $row['checkbox']));
        }
      }

}
  //add array to JSON file after array has been complete.
  fwrite($jsonfile, json_encode($a));



  fclose($jsonfile);
}
?>
