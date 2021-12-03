<?php
session_start();
//$_POST['amount']=0;
if (isset($_POST["logout"])) {
    $_SESSION['loggedIn'] = 0;
    header('Location: https://rentmcproject.000webhostapp.com/');
}
//$_SESSION['loggedIn']=0;
if ($_SESSION['loggedIn'] == 0) {

    header('Location: https://rentmcproject.000webhostapp.com/');
}
?>

<?php
function dis_tran($user){
  $servername = "localhost";
  $username = "id17927674_george";
  $password = "MCProject@151";
  $dbname = "id17927674_db";

  $conn = new mysqli($servername, $username, $password, $dbname); // Create connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 // $user=$_SESSION['username'];
  $sql="SELECT * FROM transactions WHERE user='$user' order by ID DESC";
  $result = $conn->query($sql);
  echo "
  <div id='table-div'>
  <table class='table'>
      <th>Sl.No</th>
      <th>Type</th>
      <th>Entry Time</th>
      <th>Exit Time</th>
      <th>Opening Balance</th>
      <th>Closing Balance</th>
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
}
?>
<!DOCTYPE html>
<html>
<head>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admindashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
</head>


<body style="text-align:center;">
   
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">MC Project</a>
            
           
                <!--<ul class="navbar-nav me-auto">
                    <li class="nav-item">
                       <!-- <a class="nav-link" href="javascript:void(0)">Link</a> 
                       
                    </li>
                </ul> -->
                <div class="d-flex" style="margin-left:auto;">
                    <a>
                        <form method="post">
                            <input type="submit" name="logout" class="btn btn-primary" style="width:auto;" value="Logout" />

                        </form>
                    </a>
                </div>
            
        </div>
    </nav>
    
<h1>Admin Dashboard</h1>
	
	<?php
	    $servername = "localhost";
    $username = "id17927674_george";
    $password = "MCProject@151";
    $dbname = "id17927674_db";

    $conn = new mysqli($servername, $username, $password, $dbname); // Create connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $user = $_SESSION['username'];
    $sql = "SELECT * FROM customers order by user";
    $result = $conn->query($sql);	
	
	echo "
  <div id='outertb'>
  <table class='table table-striped'>
      <th>Sl.No</th>
      <th>Name</th>
      <th>Balance</th>
      
      <th>Recharge</th>
      <th>Transactions</th>
      
      ";
$sl=1;
    while($row = $result->fetch_assoc()){
        $user=$row["user"] ;
        $sql="select closing_bal from transactions where user='$user' order by id desc limit 1";
        $res = $conn->query($sql);
        $row2=$res->fetch_assoc();
        $amount=$row2["closing_bal"];
        echo '<tr>';
        echo "<td>" . $sl . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $amount . "</td>";
	echo "<td><form method='post' action='cal.php'>
	<input type='hidden' name='user' value=$user></input>
	 <input type='number' name='amount' placeholder='Enter Amount' required=1 style='
    border: 1px solid #767676;
    border-radius: 0.5rem;
    height: 32px;
'></input>
		<input type='submit'
				class='btn btn-primary' value='Recharge' />
	
	</form> </td> <td>
	<button class='btn btn-primary' data-toggle='collapse' href=#" . $user . " role='button'
            aria-expanded='false' aria-controls=".$user.">View</button>
	";
	echo "</td></tr>";
	echo "<tr><td colspan=5 id='innertd'> <div class='collapse multi-collapse' id=" . $user. "> ";
	dis_tran($user);
	echo "</div> </td> </tr>";
	$sl++;
    }
    echo "</table>"
	?>
</head>

</html>
