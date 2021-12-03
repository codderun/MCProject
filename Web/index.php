<!DOCTYPE html>
<html lang="en">
<head>
  <title>MC Project</title>
  <meta charset="utf-8">
   <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/style1.css" rel="stylesheet">
  <script scr="js/js1.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark" id="nav">
  <div class="container-fluid">
    <a class="navbar-brand" href="javascript:void(0)">MC Project</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <div class="d-flex" style="margin-left:auto;">
      <a>
      <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="btn btn-primary">Login</button>
       </a>
      </div>
    </div>
  </div>
</nav>



<div id="id01" class="modal">
  
  <form class="modal-content animate" action="auth.php" method="GET">
    <!--<div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="images/img_avatar2.png" alt="Avatar" class="avatar">
    </div>
    -->
    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit">Login</button>
      
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>

</div>
<?php

?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="images/1.jpeg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="images/2.jpeg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="images/3.jpeg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <script src="js/script1.js"></script>
  <script>$('.carousel').carousel({
    interval: 4000
  })</script>
  <script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<div id="feature" style="display:flex; width:100%;justify-content: space-around;">
    <div style="display:flex-item;" class="fi">
        <div class="ft">
            Fully Automated
        </div>
    </div >
    <div style="display:flex-item;" class="fi">
        <div class="ft">
            One Place for all your needs
        </div>
    </div>
    <div style="display:flex-item;" class="fi">
        <div class="ft">
            Clean and Robust ui
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="page-footer font-small teal pt-4" style="
    background-color: #343a40;">

  <!-- Footer Text -->
  <div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-6 mt-md-0 mt-3" style="
    color: #f7f7f7;">

        <!-- Content -->
        <h5 class="text-uppercase font-weight-bold" style="
    color: #f7f7f7;">About Project</h5>
        <p>To design a rental system that charges automatically on tapping RFId tag on the sensor and a web interface for viewing user account details</p>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none pb-3">

      <!-- Grid column -->
      <div class="col-md-6 mb-md-0 mb-3" style="
    color: #f7f7f7;">

        <!-- Content -->
        <h5 class="text-uppercase font-weight-bold" >About Us</h5>
        <p>George Mullar J-194229<br>Yashwanth T-194280<br>Sanjay B-194116</p>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Text -->


</footer>
<!-- Footer -->
</head>
</html>


