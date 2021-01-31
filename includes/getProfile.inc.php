<?php

  session_start();
  require "dbh.inc.php";


    $sql = "SELECT * FROM account WHERE userID=?;";
    $pstmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($pstmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($pstmt, "i", $_SESSION['id']);
      mysqli_stmt_execute($pstmt);

      $result = mysqli_stmt_get_result($pstmt);

      if ($row = mysqli_fetch_assoc($result)) {


        echo "<tbody>";
        echo "<tr>";
        echo "<th scope='row'> Email </th>";
        echo "<td>" . $row['email'] . "</td>";
        echo "</tr>";
        echo "<th scope='row'> Username </th>";
        echo "<td>" . $row['username'] . "</td>";
        echo "</tr>";
        echo "<th scope='row'> Full Name </th>";
        echo "<td>" . $row['first'] . " ". $row['last'] . "</td>";
        echo "</tr>";
        echo "<th scope='row'> Monthly Goals </th>";
        echo "<td>" . $row['goals'] . " days</td>";
        echo "</tr>";
        echo "</tbdy>";


      }
    }
