<?php
session_start();
include ("db.php");
$limit = "";
$check_seats = "";
if(!empty($_SESSION['booking-data'])){$date = $_SESSION['booking-data']['travel_date'];}
if (!empty($_GET['limit'])){$limit = '<div class="alert alert-danger" role="alert">
  <strong>Route: '.$_GET["route"].'</strong><br>Sorry. There are only '.$_GET["limit"].' seats left for booking. '.$_GET["vip"].' for VIP class and '.$_GET["economy"].' for Economy class.
</div>';}
if (!empty($_GET['route_1'])){
  $check_seats = '<div class="alert alert-success" role="alert">
  <strong>Route: Nairobi-Mombasa</strong><br>
  <b>All seats:</b> '.$_GET["route_1"].' seats.<br>
  <b>VIP Class:</b> '.$_GET["vip_1"].' seats left.<br>
  <b>Economy Class:</b> '.$_GET["economy_1"].' seats left.<hr>
  <strong>Route: Mombasa-Nairobi</strong><br>
  <b>All seats:</b> '.$_GET["route_2"].' seats.<br>
  <b>VIP Class:</b> '.$_GET["vip_2"].' seats left.<br>
  <b>Economy Class:</b> '.$_GET["economy_2"].' seats left.<br>
</div>';
}
if (!empty($_GET['wrong_date'])){$check_seats = '<div class="alert alert-danger" role="alert">
  <strong>Warning!</strong> Sorry you entered a past date.
</div>';}
if(isset($_POST['clear']))
{
	session_destroy();
	header('Location: book.php');
}
if(isset($_POST['confirm']))
{   $data = $_POST["data"];
	  $columns = implode(", ",array_keys($data));
     $values  = implode("','", array_values($data));
     $values = "'".$values."'";
     $sql = "INSERT INTO bookings ($columns) VALUES ($values)";
    if (mysqli_multi_query($conn, $sql)) {
      $checkbox = $_SESSION['singles'];
      $date = $_SESSION['booking-data']['travel_date'];
      $ticket = $_POST["invoice"];
      $class = $_SESSION['booking-data']['clss'];
      $route = $_SESSION['route'];
      for($i=0;$i<count($checkbox);$i++){
      $check_id = $checkbox[$i];
      mysqli_query($conn,"insert into seats (date, seatno, ticket, class, route) values ('$date', '".$check_id."', '$ticket', '$class', '$route')") or die(mysqli_error($conn));
      }
			session_destroy();
			$ticket = $_POST["invoice"];
			header('Location: complete.php?ticket='.$ticket);
     }

}
if(!empty($_POST["seat"])){
  $str=implode(",",$_POST['data']);
  $_SESSION['reserved'] = $str;
  $_SESSION['singles'] = $_POST["data"];
  header('Location: book.php');
}
function seat_status($seatno, $type, $date){
  include ("db.php");
  $route = $_SESSION['route'];
  $sql = "SELECT seatno FROM seats where date='$date' AND seatno='$seatno' and route='$route' limit 1";
  $result = mysqli_query($conn, $sql);
  switch ($type) {
    case "div":
           while( $row = mysqli_fetch_assoc($result) ){
             $booked = $row['seatno'];
             if($booked == $seatno){echo 'class="bg-primary" onclick="booked()"';}
          }
        break;
    case "input":
           while( $row = mysqli_fetch_assoc($result) ){
           $booked = $row['seatno'];
           if($booked == $seatno){echo 'disabled';}
            }

        break;
}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book bus</title>

	 <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mob.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/materialize.css" />
		<script src="js/jquery.min.js"></script>

    <script>
    function checkAvailability() {
    $("#loader").show();
    jQuery.ajax({
    url: "processing.php",
    data:'mpesa='+$("#mpesa").val(),
    type: "POST",
    success:function(data){
    $("#mpesa-availability-status").html(data);
    $("#loader").hide();
    if(data == "<br><span style='color: red;'>Sorry. This code has been used.</span>"){
      $('#mpesa').val('');
    }

    },
    error:function (){}
    });
    }
    </script>
<style>
#ck-button {
background-color:#EFEFEF;
border-radius:4px;
border:1px solid #D0D0D0;
float:left;
}

#ck-button:hover {
background:red;
}

#ck-button label {
text-align: center;

}

#ck-button label span {
text-align:center;
width: 40px; height: 30px;
display:block;
}


#ck-button input:checked + span {
background-color:#911;
color:#fff;
width: 40px; height: 30px;
border-radius:4px;
}
.disabled {cursor: no-drop;}
</style>
</head>
<body>
  <?php include ('includes/navbar.php');?>
  <br/><br/>
		 <div class="container" style="padding-top: 20px;">
			 <div class="row">
         <?php if(empty($_SESSION['reserved'])){ ?>
           <div class="col-md-4">
             <?php if(empty($_SESSION['booking-data'])){ ?>
          <div class="card">
          <div class="card-body">
            <h5>Check for available seats</h5>
             <?php echo $check_seats; ?>
  <form method="post" action="processing.php">
      <div class="form-group">
        <label>Date of travel</label>
    <input type="date" name="travel_date" id="datefield2" class="form-control" min='2018-12-01' max='3000-13-13' style="width: 200px;" required>
    </div>


<div class="form-group">
<input type="submit" name="check_seats" class="btn btn-success" value="Check now">
</div>
</form>
</div>
</div>
<?php } ?>
</div>
				 <div class="col-md-8">
					 <div class="card">
						 <?php if(empty($_SESSION['booking-data'])){ ?>
						<div class="card-body">
  <form class="form-group " action="processing.php" method="post" onsubmit="return validate();">
		<?php echo $limit; ?>
		<h5>Please fill the form below to book a bus</h5>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
				 <select class="form-control" name="clss" style="width: 200px;"  required>
					 <option value="">--Select Class--</option>
					 <option value="vip">VIP</option>
					 <option value="economy">Economy</option>
				 </select>
			</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
			    <select id="from_select" class="form-control" name="origin" id="from" style="width: 200px;" required>
			        <option value="">--From--</option>
							<?php
			      $sql = "SELECT * FROM destinations";
				    $result = mysqli_query($conn, $sql);
			      if (mysqli_num_rows($result) > 0) {
							while( $row = mysqli_fetch_assoc($result) ){
			echo '<option value="'.$row['dest_code'].'">'.$row['destination'].'</option>';
						}
			    	} ?>
			    </select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
			    <select id="to_select" class="form-control" name="destination" id="to" style="width: 200px;" required>
						<option value="">--To--</option>
						<?php
					$sql = "SELECT * FROM destinations";
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result) > 0) {
						while( $row = mysqli_fetch_assoc($result) ){
			echo '<option value="'.$row['dest_code'].'">'.$row['destination'].'</option>';
					}
					} ?>
			    </select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
			<input type="number" id="phone" name="idno" class="form-control" placeholder="Enter Phone number" style="width: 200px;" min="0" required>
			</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
			<input type="number" name="seats" class="form-control" placeholder="Number of seats" style="width: 200px;" min="1" max="25" required>
			</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
			<input type="text" name="name" class="form-control" placeholder="Your name" style="width: 200px;" required>
			</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Date of travel</label>
			<input type="date" name="travel_date" id="datefield" class="form-control" min='2018-12-01' max='3000-13-13' style="width: 200px;" required>
			</div>
			</div>
		</div>

<div class="form-group">
<input type="submit" name="booktrain" class="btn btn-success" value="Continue..">
</div>
  </form>
</div><?php }?>

<?php if(!empty($_SESSION['booking-data'])){ ?>
<div class="card-header">
	Seat arrangement for <b><?php if($_SESSION['booking-data']['clss'] == "vip") {echo "VIP";} elseif($_SESSION['booking-data']['clss'] == "economy") {echo "Economy";} ?></b> coach.
</div>
<form action="" method="post">
<div class="card-body">
     <div class="row">
     	<div class="col-md-8">
     		<label style="color: maroon; font-size: 16px; font-weight: bolder;">Kindly Select Your Seat</label>

  		<table>
        <?php if($_SESSION['booking-data']['clss'] == "vip") {?>
           <?php $coach = "A"; ?>
  				<tr>
              <td><div id="ck-button" <?php seat_status($coach."0", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."0", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."0";  ?>"><span><?php echo $coach."0";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."1", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."1", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."1";  ?>"><span><?php echo $coach."1";  ?></span></label></div></td>
              <td>&nbsp; &nbsp;</td>
               <td><div id="ck-button" <?php seat_status($coach."2", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."2", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."2";  ?>"><span><?php echo $coach."2";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."3", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."3", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."3";  ?>"><span><?php echo $coach."3";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."4", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."4", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."4";  ?>"><span><?php echo $coach."4";  ?></span></label></div></td>
          </tr>
          <tr>
              <td><div id="ck-button" <?php seat_status($coach."5", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."5", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."5";  ?>"><span><?php echo $coach."5";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."6", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."6", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."6";  ?>"><span><?php echo $coach."6";  ?></span></label></div></td>
              <td>&nbsp; &nbsp;</td>
               <td><div id="ck-button" <?php seat_status($coach."7", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."7", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."7";  ?>"><span><?php echo $coach."7";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."8", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."8", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."8";  ?>"><span><?php echo $coach."8";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."9", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."9", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."9";  ?>"><span><?php echo $coach."9";  ?></span></label></div></td>
          </tr>
          <tr>
              <td><div id="ck-button" <?php seat_status($coach."10", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."10", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."10";  ?>"><span><?php echo $coach."10";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."11", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."11", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."11";  ?>"><span><?php echo $coach."11";  ?></span></label></div></td>
              <td>&nbsp; &nbsp;</td>
               <td><div id="ck-button" <?php seat_status($coach."12", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."12", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."12";  ?>"><span><?php echo $coach."12";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."13", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."13", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."13";  ?>"><span><?php echo $coach."13";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."14", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."14", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."14";  ?>"><span><?php echo $coach."14";  ?></span></label></div></td>
          </tr>
          <tr>
              <td><div id="ck-button" <?php seat_status($coach."15", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."15", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."15";  ?>"><span><?php echo $coach."15";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."16", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."16", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."16";  ?>"><span><?php echo $coach."16";  ?></span></label></div></td>
              <td>&nbsp; &nbsp;</td>
               <td><div id="ck-button" <?php seat_status($coach."17", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."17", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."17";  ?>"><span><?php echo $coach."17";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."18", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."18", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."18";  ?>"><span><?php echo $coach."18";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."19", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."19", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."19";  ?>"><span><?php echo $coach."19";  ?></span></label></div></td>
          </tr>
          <tr>
              <td><div id="ck-button" <?php seat_status($coach."20", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."20", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."20";  ?>"><span><?php echo $coach."20";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."21", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."21", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."21";  ?>"><span><?php echo $coach."21";  ?></span></label></div></td>
              <td>&nbsp; &nbsp;</td>
               <td><div id="ck-button" <?php seat_status($coach."22", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."22", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."22";  ?>"><span><?php echo $coach."22";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."23", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."23", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."23";  ?>"><span><?php echo $coach."23";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."24", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."24", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."24";  ?>"><span><?php echo $coach."24";  ?></span></label></div></td>
          </tr>
        <?php } ?>
        <?php if($_SESSION['booking-data']['clss'] == "economy") {?>
              <?php $coach = "B"; ?>
          </tr>

          <tr>
              <td><div id="ck-button" <?php seat_status($coach."0", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."0", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."0";  ?>"><span><?php echo $coach."0";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."1", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."1", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."1";  ?>"><span><?php echo $coach."1";  ?></span></label></div></td>
              <td>&nbsp; &nbsp;</td>
               <td><div id="ck-button" <?php seat_status($coach."2", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."2", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."2";  ?>"><span><?php echo $coach."2";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."3", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."3", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."3";  ?>"><span><?php echo $coach."3";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."4", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."4", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."4";  ?>"><span><?php echo $coach."4";  ?></span></label></div></td>
          </tr>
          <tr>
              <td><div id="ck-button" <?php seat_status($coach."5", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."5", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."5";  ?>"><span><?php echo $coach."5";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."6", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."6", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."6";  ?>"><span><?php echo $coach."6";  ?></span></label></div></td>
              <td>&nbsp; &nbsp;</td>
               <td><div id="ck-button" <?php seat_status($coach."7", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."7", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."7";  ?>"><span><?php echo $coach."7";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."8", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."8", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."8";  ?>"><span><?php echo $coach."8";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."9", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."9", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."9";  ?>"><span><?php echo $coach."9";  ?></span></label></div></td>
          </tr>
          <tr>
              <td><div id="ck-button" <?php seat_status($coach."10", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."10", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."10";  ?>"><span><?php echo $coach."10";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."11", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."11", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."11";  ?>"><span><?php echo $coach."11";  ?></span></label></div></td>
              <td>&nbsp; &nbsp;</td>
               <td><div id="ck-button" <?php seat_status($coach."12", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."12", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."12";  ?>"><span><?php echo $coach."12";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."13", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."13", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."13";  ?>"><span><?php echo $coach."13";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."14", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."14", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."14";  ?>"><span><?php echo $coach."14";  ?></span></label></div></td>
          </tr>
          <tr>
              <td><div id="ck-button" <?php seat_status($coach."15", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."15", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."15";  ?>"><span><?php echo $coach."15";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."16", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."16", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."16";  ?>"><span><?php echo $coach."16";  ?></span></label></div></td>
              <td>&nbsp; &nbsp;</td>
               <td><div id="ck-button" <?php seat_status($coach."17", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."17", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."17";  ?>"><span><?php echo $coach."17";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."18", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."18", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."18";  ?>"><span><?php echo $coach."18";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."19", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."19", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."19";  ?>"><span><?php echo $coach."19";  ?></span></label></div></td>
          </tr>
          <tr>
              <td><div id="ck-button" <?php seat_status($coach."20", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."20", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."20";  ?>"><span><?php echo $coach."20";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."21", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."21", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."21";  ?>"><span><?php echo $coach."21";  ?></span></label></div></td>
              <td>&nbsp; &nbsp;</td>
               <td><div id="ck-button" <?php seat_status($coach."22", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."22", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."22";  ?>"><span><?php echo $coach."22";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."23", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."23", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."23";  ?>"><span><?php echo $coach."23";  ?></span></label></div></td>
              <td><div id="ck-button" <?php seat_status($coach."24", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."24", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."24";  ?>"><span><?php echo $coach."24";  ?></span></label></div></td>
          </tr>
        <?php } ?>
      </table>
     	</div>
      <div class="col-md-4" style="padding-left: 4%;">
     		<label style="color: green; font-weight: bolder; font-size: 15px;">Key</label>
     		 <ul>
     		 	<li style="font-weight: bolder; font-size: 18px;"><button class="btn btn-primary" style="width: 40px; height: 30px; "></button>&nbsp;&nbsp;&nbsp;Booked
     		 	</li>
     		 	<br/>
     		 	<li style="font-weight: bolder; font-size: 18px;"><button class="btn btn-default" style="width: 40px; height: 30px; "></button>&nbsp;&nbsp;&nbsp;Empty
     		 	</li>
     		 	<br/>
     		 	<li style="font-weight: bolder; font-size: 18px;"><button class="btn btn-danger" style="width: 40px; height: 30px; "></button>&nbsp;&nbsp;&nbsp;Your Seat
     		 	</li>
     		 </ul>
     	</div>
     	<div class="col-md-3">

     	</div>
     </div>
     <br>
     <div class="form-group">
     <input type="submit" name="seat" class="btn btn-success" value="Reserve selected seat(s)">
     </div>
	</div>
  </form>
	<?php } ?>

</div>
</div>


<?php }?>
<?php if(!empty($_SESSION['reserved'])){ ?>
  <div class="col-md-6">
     <div class="card">
       <div class="card-header">
       	Your booking details
       </div>
       <div class="card-body">
       	<div class="row">
          <div class="col-md-6">
           <p><b>Class:</b> <span id="seats"><?=$_SESSION['booking-data']['name'];?></span>
       	 </div>
          <div class="col-md-6">
           <p><b>Class:</b> <span id="seats"><?=$_SESSION['booking-data']['clss'];?></span>
       	 </div>
       	 <div class="col-md-6">
           <b> No.of seats:</b> <span id="seats"><?=$_SESSION['booking-data']['seats'];?></span></p>
       	 </div>
       	 <div class="col-md-6">
           <p><b>From:</b> <span id="from"><?=$_SESSION['start'];?></span></p>
       	 </div>
       	 <div class="col-md-6">
           <p><b>To:</b> <span id="to"><?=$_SESSION['stop'];?></span></p>
       	 </div>
       	 <div class="col-md-6">
            <p><b>Phone Number:</b> <span id="idno"><?=$_SESSION['idno'];?></span></p>
       	 </div>
       	 <div class="col-md-6">
           <p><b>Unit Cost:</b> <span id="cost"><?=number_format($_SESSION['price'],2,".",",");?></span></p>
       	 </div>
         <div class="col-md-6">
         <p><b>Total Cost:</b> <span id="total"><?=number_format(($_SESSION['price']*$_SESSION['seats']),2,".",",");?></span></p>
         </div>
       	</div>
        <p style="color: green;">If all the details are okay, proceed to pay for your booking via Mpesa to complete your reservations.
       	       	<form class="form-group " action="" method="post">
       		<div class="row">
            <div class="col-md-6">
       			 <div class="form-group">
       		 	<input type="submit" name="clear" class="btn btn-danger" value="Cancel">
       		 	</div>
       		 </div>
       		 <div class="col-md-6">
       		 </div>
       		</div>
       	  </form>
       	</div>
     </div>
  </div>
<div class="col-md-6">
	<div class="card">
		<?php if(!empty($_SESSION['booking-data'])){ ?>
	  <div class="card-header">
	    Payment details
	  </div>
		<div class="card-body">
			<p>Go to <b>Lipa na M-Pesa > Paybill</b>
			<p>Business number:<b> 230023</b>
			<p>Account name: <b><?=$_SESSION['idno'];?></b></p>
			<p>Amount: <b><?=number_format(($_SESSION['price']*$_SESSION['seats']),2,".",",");?></b></p>
			<p><small>Then submit your transaction code below.</small></p>
      <span id="mpesa-availability-status"></span>
				<form class="form-group " action="" method="post">
					<div class="form-group">
				<input id="mpesa" type="text" name="data[mpesa]" class="form-control" placeholder="Enter M-Pesa Code" style="width: 200px;" onkeyup="checkAvailability()" required>
				</div>
        <p><img src="LoaderIcon.gif" id="loader" style="display:none;" /></p>
        <input type="hidden" name="data[seat]" value="<?=$_SESSION['reserved'];?>">
				<input type="hidden" name="data[name]" value="<?=$_SESSION['booking-data']['name'];?>">
        <input type="hidden" name="data[class]" value="<?=$_SESSION['booking-data']['clss'];?>">
				<input type="hidden" name="data[idno]" value="<?=$_SESSION['idno'];?>">
				<input type="hidden" name="data[seats_no]" value="<?=$_SESSION['booking-data']['seats'];?>">
				<input type="hidden" name="data[place_from]" value="<?=$_SESSION['start'];?>">
				<input type="hidden" name="data[place_to]" value="<?=$_SESSION['stop'];?>">
				<input type="hidden" name="data[unit_cost]" value="<?=number_format($_SESSION['price'],2,".",",");?>">
				<input type="hidden" name="data[dated]" value="<?php echo date("Y/m/d");?>">
				<input type="hidden" name="data[total_price]" value="<?=number_format(($_SESSION['price']*$_SESSION['seats']),2,".",",");?>">
				<input type="hidden" name="data[invoice]" value="<?=$_SESSION['invoice_no'];?>">
				<input type="hidden" name="invoice" value="<?=$_SESSION['invoice_no'];?>">
				<input type="hidden" name="data[travel_date]" value="<?=$_SESSION['booking-data']['travel_date'];?>">
						 <div class="form-group">
					 	<input type="submit" name="confirm" class="btn btn-sm btn-success" value="Confirm Payment">
					 	</div>
				  </form>
      </div>
			<?php }?>
	</div>
</div>
<?php }?>
</div>
</div>
<script>
$(document).ready(function() {
    $("#to_select").children('option:gt(0)').show();
    $("#from_select").change(function() {
        $("#to_select").children('option').show();
        $("#to_select").children("option[value^=" + $(this).val() + "]").hide()
    })

    $("#from_select").children('option:gt(0)').show();
    $("#to_select").change(function() {
        $("#from_select").children('option').show();
        $("#from_select").children("option[value^=" + $(this).val() + "]").hide()
    })
})
</script>
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
document.getElementById("datefield").setAttribute("min", today);
document.getElementById("datefield2").setAttribute("min", today);
</script>
<script>
var limit = <?php echo $_SESSION['booking-data']['seats']; ?>;
$('input[type=checkbox]').on('change', function (e) {
    if ($('input[type=checkbox]:checked').length > <?php echo $_SESSION['booking-data']['seats']; ?>) {
        $(this).prop('checked', false);
        alert("You qualify for only <?php echo $_SESSION['booking-data']['seats']; ?> seat(s)");
    }
});
</script>
<script>
function booked() {
alert("This seat has been taken! Please pick another one.");
}
</script>
<script>function validate() {
 // check if input is bigger than 3
 var value = document.getElementById('phone').value;
 if (value.length < 10) {
   alert("Invalid length for phone number.");
   return false; // keep form from submitting
 }
 return true;
}</script>
<script>function validate2() {
 // check if input is bigger than 3
 var value = document.getElementById('mpesa').value;
 if (value.length < 10) {
   alert("Invalid length for the M-pesa code.");
   return false; // keep form from submitting
 }
 return true;
}</script>
</body>
</html>
