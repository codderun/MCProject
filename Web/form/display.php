<html>

<body>
  <?php
  date_default_timezone_set('Asia/Kolkata');
  $idrs = $_GET["rfid"];
  $servername = "localhost";
  $username = "id17927674_george";
  $password = "MCProject@151";
  $dbname = "id17927674_db";

  $conn = new mysqli($servername, $username, $password, $dbname); // Create connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  //to get username from rfid
  $sql = "select user from customers where rfid=$idrs limit 1";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $user = $row["user"];
  //echo $user. $idrs;
  $sql="select count(*) as rowc from transactions where user='$user' ";//to know table is null
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $res = $row["rowc"];
  //echo $res;
  if(!$res){ // dont exist
  //$ct=timetostr(strtotime(now())+(5*60+30)*60);
      $sql = "INSERT into transactions(user,entry_time,opening_bal,type) values('$user',now(),1000,'Debit')";
      $result = $conn->query($sql);
      //if(!$result) echo "wrong";
      echo "w1000;".$user .";";
  }
  else{ //exist
  //echo $user;
      //$sql="select count(exit_time) as c from transactions where user='$user' order by id desc limit 1";//to know last exit time is null
     // $result = $conn->query($sql);
     // $row = $result->fetch_assoc();
      //$res = $row["c"]; //c==0 _> null
     // echo $res;
      $sql="select exit_time as c from transactions where user='$user' order by id desc limit 1";//to know last exit time is null
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $res = $row["c"]; //c==0 _> null
      //echo $res;
      if(!$res){ // about to exit null
      
      $sql = "update transactions set exit_time=now() where user='$user' order by id desc limit 1"; //set exit time
      //echo now();
      $result = $conn->query($sql);
        $sql="select entry_time, exit_time, opening_bal from transactions where user='$user' order by id desc limit 1";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $st=$row["entry_time"];
        //echo "<br>" . $st;
        $et=$row["exit_time"];
        $stp = strtotime($st);
        $etp = strtotime($et);
        $interval=$etp-$stp;
        //echo "<br> interval=" . $interval;
        $cf=1; //conversion factor 1 rupee/sec
        $deduct=$cf*$interval;
        //echo "<br>" . $row["opening_bal"];
        $closing_bal= $row["opening_bal"]-$deduct;
        echo "e" . $closing_bal . ";" .$user .";";
        $sql="update transactions set closing_bal=$closing_bal where user='$user' order by id desc limit 1";
        $conn->query($sql);
      }
      else{ //re-entry
          $sql="select closing_bal from transactions where user='$user' order by id desc limit 1";
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
          $balance=$row["closing_bal"];
          echo "w" . $balance . ";" . $user . ";";
          if($balance<0) {
              echo "hi";
          }
          else{
          $sql = "INSERT into transactions(user,entry_time,opening_bal,type) values('$user',now(),$balance,'Debit')";
          $result = $conn->query($sql);
      }
      }
  }
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $conn->close();
  ?>

</head>

</html>