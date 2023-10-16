<?php
session_start();
include ("db.php");
session_destroy();
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ZinniaWays Home</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="css/stylic.css" rel="stylesheet">
     <!-- All Jquery -->
    <script src="js/jquery.min.js"></script>
    <!--   Bootstrap -->
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <style>
    .error {
        color: #ff2c34 !important;
        font-size: 14px !important;
        font-weight: 400 !important;
    }
    </style>
</head>
<body>
<?php
include 'includes/navbar.php';
?>
<br/><br/>
   <div class="navbar" style="background:#762631; color:#FFFFFF;">
    <h4 style="position:relative; left:30px; color:#fff">Car & Bus Booking System</h4>
    <form class="form-inline" method="post" action="processing.php">
        <div class="form-group">
          <label>Date of travel</label>
      <input type="date" name="travel_date" id="datefield2" class="form-control" min='2018-12-01' max='3000-13-13' style="width: 200px; margin: 6px;" required>
      </div>


  <div class="form-group">
  <input type="submit" name="check_seats" class="btn btn-success" value="Check Availability">
  </div>
  </form>
</div>
<div class="container">
        <br/>
      <div class="row">
        <div class="col-md-8">
         <?php include 'slideshow.php';?>
        </div>
        <div class="col-md-4">
          <div class="card" style="width: 18rem;">
            <div class="card-header">
              Summery
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Travel in comfort</li>
              <li class="list-group-item">Affordable rates</li>
              <li class="list-group-item">Fastest land transport</li>
              <li class="list-group-item">Inter-county connections</li>
              <li class="list-group-item">Reliable</li>
              <li class="list-group-item"><a href="book.php" class="btn btn-success">Book now</a></li>
            </ul>
          </div>

        </div>
      </div>
      <div class="row">
           <label style="position:relative; left:40px; color:#FF5624; font-size:17px; font-family:Cambria, Cochin, Georgia, Times, Times New Roman, serif">Destinations
           </label>
       </div>
    <div class="row">
        <div class="col-md-6" style="padding-left: 3%;">
            <img src="images/k.jpg" alt="Package Management" class="img-responsive" style="width: 90%;" /><br />
            <h3>Nairobi</h3>
            <p>
                Book vehicles from your location to Nairobi<br />
            </p>
        </div>
        <div class="col-md-6">
            <img src="images/l.jpg" alt="Package Management" class="img-responsive" style="width:100%;" /><br />
            <h3>Mombasa</h3>
            <p>
                Book vehicles from your location to Mombasa.<br />
            </p>
        </div>
    </div>
 </div>
 <script>
 var today = new Date();
 var dd = today.getDate();
 var mm = today.getMonth()+1; //January is 0!
 var yyyy = today.getFullYear();
  if(dd<10){
         dd='0'+dd
     }
     if(mm<10){
         mm='0'+mm
     }

 today = yyyy+'-'+mm+'-'+dd;
 document.getElementById("datefield2").setAttribute("min", today);
 </script>
</body>

</html>
