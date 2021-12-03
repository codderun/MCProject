<?php
function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}
  $servername = "localhost";
  $username = "id17927674_george";
  $password = "MCProject@151";
  $dbname = "id17927674_db";
  $conn = new mysqli($servername, $username, $password, $dbname); // Create connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if($_SERVER['REQUEST_METHOD'] == "GET"){
    //echo $_GET["uname"];
    $username = $_GET['uname'];
    $password = $_GET['psw'];
    $stmt = $conn->query("SELECT user, password FROM credentials WHERE user='$username' AND  password='$password' LIMIT 1");
    
    $row=$stmt->fetch_assoc();
    $url="https://rentmcproject.000webhostapp.com/dashboard/userdashboard.php";
     //header('Location: https://rentmcproject.000webhostapp.com/dashboard/userdashboard.php');
    if($stmt->num_rows == 1) { //To check if the row exists
        
        
        $stmt->close();
        //echo "successfullll";
        session_start();
        $_SESSION['loggedIn'] = true;
        //$_SESSION['user_id'] = 0;
        $_SESSION['username'] = $username;
        //echo $_SESSION['loggedIn'];
        
        //sleep(3);
        if($username=="admin"){
            header('Location: https://rentmcproject.000webhostapp.com/dashboard/admindashboard.php');
        }
        else
        header('Location: https://rentmcproject.000webhostapp.com/dashboard/userdashboard.php');
        exit();
        
    }
    else{
        $_SESSION['loggedIn'] = false;
        echo "wrong pass";
    }
}
    ?>