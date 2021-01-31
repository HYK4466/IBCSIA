<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src='https://code.jquery.com/jquery-3.4.1.min.js'></script>

  <title>View Exercises</title>

  <style>
    .table {
      width: 40%;
      margin-left: -350px;
      margin-top: 85px;
    }

    td {
      text-align: center;
    }

    th {
      text-align: center;
    }

    .btn-primary {
      margin-left: 445;
      margin-top: 10;
    }
  </style>


</head>
<main>

  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <form class="adding" action="home.php" method="post">
        <button type="submit" class="btn" name="home">Home</button>
      </form>
    </li>
  </ul>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
    <h1>Your Exercises</h1>
        <table class="table" >
          <tbody id="information">
            <tr>
              <th>Exercises</th>
            </tr>

          </tbody>
        </table>

        <form name="updateform" class="col-12" action="deleteSport.php" method="post">
          <button type="submit" class="btn btn-primary" name="delete">Delete Exercise</button>
        </form>

        <script type="text/javascript" src="viewActivity.js"></script>
  </div>
</div>

</main>
</html>
