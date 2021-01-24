<?php

  session_start();
  require "dbh.inc.php";

    $sql = "SELECT sportid FROM exevents WHERE id=? GROUP BY sportid ORDER BY count(sportid) DESC LIMIT 1;";
    $pstmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($pstmt, $sql);
      mysqli_stmt_bind_param($pstmt, "i", $_SESSION['id']);
      mysqli_stmt_execute($pstmt);

      $result = mysqli_stmt_get_result($pstmt);
      if ($row = mysqli_fetch_assoc($result)) {

        $sqlSport = "SELECT sportsName FROM sports WHERE sportsID=?;";
        $astmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($astmt, $sqlSport);
          mysqli_stmt_bind_param($astmt, "i", $row['sportid']);
          mysqli_stmt_execute($astmt);
          $result = mysqli_stmt_get_result($astmt);
          if ($row = mysqli_fetch_assoc($result)) {
            $frequentSport = $row['sportsName'];
          }
      }

      $sqlStartTime = "SELECT startTime FROM exevents WHERE id=? GROUP BY startTime ORDER BY count(startTime) DESC LIMIT 1;";
      $pstmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($pstmt, $sqlStartTime);
        mysqli_stmt_bind_param($pstmt, "i", $_SESSION['id']);
        mysqli_stmt_execute($pstmt);

        $result = mysqli_stmt_get_result($pstmt);
        if ($row = mysqli_fetch_assoc($result)) {
          $frequentStartTime = $row['startTime'];
        }

        $sqlStopTime = "SELECT stopTime FROM exevents WHERE id=? GROUP BY stopTime ORDER BY count(stopTime) DESC LIMIT 1;";
        $pstmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($pstmt, $sqlStopTime);
          mysqli_stmt_bind_param($pstmt, "i", $_SESSION['id']);
          mysqli_stmt_execute($pstmt);

          $result = mysqli_stmt_get_result($pstmt);
          if ($row = mysqli_fetch_assoc($result)) {
            $frequentStopTime = $row['stopTime'];
          }

          $sqlTimeduration = "SELECT TIMEDIFF(?, ?) as dateDiff;";
          $pstmt = mysqli_stmt_init($conn);
          mysqli_stmt_prepare($pstmt, $sqlTimeduration);
          mysqli_stmt_bind_param($pstmt, "ss", $frequentStopTime, $frequentStartTime);

          mysqli_stmt_execute($pstmt);

          $result = mysqli_stmt_get_result($pstmt);
          if ($row = mysqli_fetch_assoc($result)) {
            $duration = $row['dateDiff'];
          }


          echo "<tbody>";
          echo "<tr>";
          echo "<th scope='row'> Frequent Sport </th>";
          echo "<td>" . $frequentSport . "</td>";
          echo "</tr>";
          echo "<th scope='row'> Frequent Start Time </th>";
          echo "<td>" . $frequentStartTime . "</td>";
          echo "</tr>";
          echo "<th scope='row'> Frequent Stop Time </th>";
          echo "<td>" . $frequentStopTime . "</td>";
          echo "</tr>";
          echo "<th scope='row'> Duration </th>";
          echo "<td>" . $duration . "</td>";
          echo "</tr>";
          echo "</tbdy>";
