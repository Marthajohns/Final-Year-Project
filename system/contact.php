<?php
session_start();
include ("db.php");
$message = "";
if(!empty($_POST["sub_data"])){
    $table = $_POST["table"];
    $data = $_POST["data"];
    $columns = implode(", ",array_keys($data));
    $values  = implode("','", array_values($data));
    $values = "'".$values."'";
      $sql = "INSERT INTO $table ($columns) VALUES ($values)";
   if (mysqli_multi_query($conn, $sql)) {
   $message = "<div class='alert alert-success' id='success-alert'>
      <button type='button' class='close' data-dismiss='alert'>x</button>
      <strong>Success! </strong>
      We have recieved your message.
      </div>";
    } else {
    $message = "<div class='alert alert-danger' id='success-alert'>
      <button type='button' class='close' data-dismiss='alert'>x</button>
      <strong>Error! </strong>
      Sorry there was a problem.
   </div>";;
}
}
        ?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact us</title>
	<!DOCTYPE html>
	<html>
	<head>
		<title>standard guage railway</title>
		<link rel="stylesheet" href="css/style.css">
		 <link rel="stylesheet" href="css/mob.css">
		 <link rel="stylesheet" href="css/bootstrap.css">
		 <link rel="stylesheet" href="css/materialize.css" />
		 <link rel="stylesheet" href="font/css/font-awesome.min.css">
		 <script src="js/jquery.min.js"></script>
		 <style>
		 #contatti{
		   background-color: #70c3be;
		   letter-spacing: 2px;
		   }
		 #contatti a{
		   color: #fff;
		   text-decoration: none;
		 }


		 @media (max-width: 575.98px) {

		   #contatti{padding-bottom: 800px;}
		   #contatti .maps iframe{
		     width: 100%;
		     height: 450px;
		   }
		  }


		 @media (min-width: 576px) {

		    #contatti{padding-bottom: 800px;}

		    #contatti .maps iframe{
		      width: 100%;
		      height: 450px;
		    }
		  }

		 @media (min-width: 768px) {

		   #contatti{padding-bottom: 350px;}

		   #contatti .maps iframe{
		     width: 100%;
		     height: 850px;
		   }
		 }

		 @media (min-width: 992px) {
		   #contatti{padding-bottom: 200px;}

		    #contatti .maps iframe{
		      width: 100%;
		      height: 700px;
		    }
		 }


		 #author a{
		   color: #fff;
		   text-decoration: none;

		 }
		 </style>
	</head>
	<body>

		<?php include ('includes/navbar.php');?>

		<br/><br/>
		   <div class="navbar" style="background:#762631; color:#FFFFFF;">
		    <h4 style="position:relative; left:30px; color:#fff">Madaraka-Express Booking System</h4>
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

		<div class="row" id="contatti">
	<div class="container mt-5" >

	    <div class="row" style="height:550px;">
	      <div class="col-md-6 maps" >
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63820.107687016294!2d36.83083263843152!3d-1.321749303201531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x80490dd7a21cca2!2sNairobi+Terminus+Ticket+Office!5e0!3m2!1sen!2ske!4v1545849026048" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
	      </div>
	      <div class="col-md-6">
	        <h5 class="text-uppercase mt-3 font-weight-bold text-white">CONTACT US</h5>
					<?php echo $message; ?><br />
	        <form action="" method="post">
	          <div class="row">
	            <div class="col-lg-6">
	              <div class="form-group">
	                <input type="text" class="form-control mt-2" name="data[name]" placeholder="Name" required>
	              </div>
	            </div>
	            <div class="col-lg-6">
	              <div class="form-group">
	                <input type="text" class="form-control mt-2" name="data[county]" placeholder="County" required>
	              </div>
	            </div>
	            <div class="col-lg-6">
	              <div class="form-group">
	                <input type="email" class="form-control mt-2" name="data[email]" placeholder="Email" required>
	              </div>
	            </div>
	            <div class="col-lg-6">
	              <div class="form-group">
	                <input type="number" class="form-control mt-2" name="data[phone]" placeholder="Phone" required>
	              </div>
	            </div>
	            <div class="col-12">
	              <div class="form-group">
	                <textarea class="form-control" id="exampleFormControlTextarea1" name="data[message]" placeholder="Your message" rows="3" required></textarea>
	              </div>
	            </div>
	            <div class="col-12">
								<input name="table" type="hidden" value="contacts">
	              <input class="btn btn-primary" name="sub_data" type="submit" value="Submit">
	            </div>
	          </div>
	        </form>
	        <div class="text-white">
	        <h4 class="text-uppercase mt-4 font-weight-bold">Hot Lines</h4>

	        <i class="fa fa-phone mt-3"></i> <a href="tel:+">(+254) 123456</a><br>
	        <i class="fa fa-phone mt-3"></i> <a href="tel:+">(+254) 123456</a><br>
	        <i class="fa fa-envelope mt-3"></i> <a href="">info@sgr.org.it</a><br>
	        <i class="fa fa-globe mt-3"></i> Mombasa terminus<br>
	        <i class="fa fa-globe mt-3"></i> Nairobi terminus<br>
	        <div class="my-4">
	        <a href=""><i class="fa fa-facebook fa-3x pr-4"></i></a>
	        <a href=""><i class="fa fa-linkedin fa-3x"></i></a>
	        </div>
	        </div>
	      </div>

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
	<script>
		$("#success-alert").fadeTo(4000, 700).slideUp(700, function(){
				$("#success-alert").slideUp(700);
		});
		</script>
</body>
</html>
