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

          echo "<input autocomplete='off' list='search' type='text' class='dropdown' name='sport' placeholder='Sports' value=".$frequentSport.">";
          echo "<datalist id='search'>";
            echo "<script type = 'text/javascript' src='sport.js'></script>";
          echo "</datalist>";
          echo "<input type='date' name='date' placeholder='Start Date'>";
          echo "<input type='time' name='starttime' placeholder='xx:xx' value = ". $frequentStartTime . ">";
          echo "<input type='time' name='stoptime' placeholder='xx:xx' value=". $frequentStopTime.">";
          echo "<button type='submit' class='btn btn-primary' name='add'>Add</button>";
