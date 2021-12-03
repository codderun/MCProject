<?php
session_start();
if(isset($_POST["logout"])) {
            $_SESSION['loggedIn']=0;
            header('Location: https://rentmcproject.000webhostapp.com/');
        }
//$_SESSION['loggedIn']=0;
  if($_SESSION['loggedIn']==0){
      
      header('Location: https://rentmcproject.000webhostapp.com/'); //redirecting to home page
  }
 // echo $_SESSION['loggedIn'] . "<br>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="javascript:void(0)">MC Project</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <div class="d-flex" style="margin-left:auto;">
      <a><form method="post">
        <input type="submit" name="logout"
                value="logout" class="btn btn-primary"/>
        
    </form>
       </a>
      </div>
    </div>
  </div>
</nav>
<h1 align="center">User Dashboard</h1>
<?php
  
  $servername = "localhost";
  $username = "id17927674_george";
  $password = "MCProject@151";
  $dbname = "id17927674_db";

  $conn = new mysqli($servername, $username, $password, $dbname); // Create connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $user=$_SESSION['username'];
  $sql="SELECT * FROM transactions WHERE user='$user' order by ID DESC";
  $result = $conn->query($sql);
  echo "
  <div id='table-div'>
  <table class='table table-striped'>
      <th>Sl.No</th>
      <th>Type</th>
      <th>entry time</th>
      <th>exit time</th>
      <th>opening balance</th>
      <th>closing balance</th>
      ";
      $sl=1;
  while($row=$result->fetch_assoc())
  {
      
     echo "<tr>";
      echo "<td>" . $sl . "</td>";
      echo "<td>" . $row["type"] . "</td>";
      echo "<td>" . $row["entry_time"] . "</td>";
      echo "<td>" . $row["exit_time"] . "</td>";
      echo "<td>" . $row["opening_bal"] . "</td>";
      echo "<td>" . $row["closing_bal"] . "</td>";
      echo "</tr>";
      $sl++;
  }
  echo "</table> </div>";
  
?>
</head>
</html>