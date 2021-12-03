<?php


    $servername = "localhost";
    $username = "id17927674_george";
    $password = "MCProject@151";
    $dbname = "id17927674_db";
    //echo "came";
    $user=$_POST['user'];
    //echo $user;
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "select closing_bal from transactions where user='$user' order by id desc limit 1";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $amount = $_POST['amount'];
    //echo "re". $amount;
    $prev=$row["closing_bal"];
    $amount = $amount+$prev;
    //echo $row["closing_bal"];
   // echo $amount;
    $sql = "insert into transactions(user,entry_time,exit_time,opening_bal,closing_bal,type)
    values('$user',now(),now(),$prev,$amount,'Credit')";
    $res = $conn->query($sql);
    header("Location: https://rentmcproject.000webhostapp.com/dashboard/admindashboard.php")

?>