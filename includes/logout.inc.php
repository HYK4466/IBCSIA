<?php


  session_start();
  if (isset($_SESSION['id'])) {

    unset($_SESSION['id']);
    unset($_SESSION['userName']);

    session_destroy();

    header("Location: ../index.php?success=logout");
    echo "<script>
      alert('Logged Out');
      </script>";
      exit();

}

 ?>
