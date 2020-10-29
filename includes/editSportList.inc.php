<?php

session_start();

require "dbh.inc.php";

$response = array();
$sql = "SELECT sportsName FROM sports;";
$pstmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($pstmt, $sql)) {
  header("Location: ../index.php?error=sqlerror");
  exit();
}
else {
  mysqli_stmt_execute($pstmt);
  $result = mysqli_stmt_get_result($pstmt);
  $a = array();
  $i = 0;


  $jsonfile = fopen("../sportlist.json", "w");


  while($row = mysqli_fetch_assoc($result)) {

          array_push($a, array("sport" => $row['sportsName']));

      }
}
  //add array to JSON file after array has been complete.
  fwrite($jsonfile, json_encode($a));



  fclose($jsonfile);
?>
