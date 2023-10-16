<?php
session_start();
include ("db.php");
date_default_timezone_set('Africa/Nairobi');

if(isset($_POST['check_seats']))
{  //Route Nairobi-Mombasa
	$route = "Nairobi-Mombasa";
	$available = $_POST['travel_date'];
 	$sql = "SELECT * FROM seats where date='$available' and route='$route'";
 	$result = mysqli_query($conn, $sql);
 	$count = mysqli_num_rows($result);
 	$r1_all = 50-$count;
 	$sql2 = "SELECT * FROM seats where date='$available' and class='vip' and route='$route'";
 	$result2 = mysqli_query($conn, $sql2);
 	$count2 = mysqli_num_rows($result2);
 	$r1_vip = 25-$count2;
 	$sql3 = "SELECT * FROM seats where date='$available' and class='economy' and route='$route'";
 	$result3 = mysqli_query($conn, $sql3);
 	$count3 = mysqli_num_rows($result3);
 	$r1_economy = 25-$count3;

	//Route Mombasa-Nairobi
	$route = "Mombasa-Nairobi";
		$available = $_POST['travel_date'];
	 	$sql = "SELECT * FROM seats where date='$available' and route='$route'";
	 	$result = mysqli_query($conn, $sql);
	 	$count = mysqli_num_rows($result);
	 	$r2_all = 50-$count;
	 	$sql2 = "SELECT * FROM seats where date='$available' and class='vip' and route='$route'";
	 	$result2 = mysqli_query($conn, $sql2);
	 	$count2 = mysqli_num_rows($result2);
	 	$r2_vip = 25-$count2;
	 	$sql3 = "SELECT * FROM seats where date='$available' and class='economy' and route='$route'";
	 	$result3 = mysqli_query($conn, $sql3);
	 	$count3 = mysqli_num_rows($result3);
	 	$r2_economy = 25-$count3;

	 header('Location: book.php?route_1='.$r1_all.'&vip_1='.$r1_vip.'&economy_1='.$r1_economy.'&route_2='.$r2_all.'&vip_2='.$r2_vip.'&economy_2='.$r2_economy);
}

if(isset($_POST['booktrain']))
{
	$_SESSION['booking-data'] = $_POST;
	$_SESSION['seats']=$conn->real_escape_string($_POST['seats']);
	$_SESSION['class']=$conn->real_escape_string($_POST['clss']);
	$_SESSION['idno']=$conn->real_escape_string($_POST['idno']);
	$_SESSION['from']=$conn->real_escape_string($_POST['origin']);
	$_SESSION['to']=$conn->real_escape_string($_POST['destination']);

	//Setting the route name
			if ($_SESSION['to']>$_SESSION['from']){$route = "Nairobi-Mombasa"; $_SESSION['route'] = $route;}
			 else {$route = "Mombasa-Nairobi"; $_SESSION['route'] = $route;}

 $available = $_SESSION['booking-data']['travel_date'];
	$sql = "SELECT * FROM seats where date='$available' and route='$route'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
	$all = 50-$count;
	$sql2 = "SELECT * FROM seats where date='$available' and class='vip' and route='$route'";
	$result2 = mysqli_query($conn, $sql2);
	$count2 = mysqli_num_rows($result2);
	$vip = 25-$count2;
	$sql3 = "SELECT * FROM seats where date='$available' and class='economy' and route='$route'";
	$result3 = mysqli_query($conn, $sql3);
	$count3 = mysqli_num_rows($result3);
	$economy = 25-$count3;
	$clss = $_SESSION['booking-data']['clss'];
	if($clss == "vip"){$limit = $vip;}elseif($clss == "economy"){$limit = $economy;}
	if ($_SESSION['seats'] <= $limit){

		if ($_SESSION['to']>$_SESSION['from']){$distance = $_SESSION['to']-$_SESSION['from'];}
		 else {$distance = $_SESSION['from']-$_SESSION['to'];}
	  $distance = 7-$distance;
		$fare = $distance*100;
		if($_SESSION['class']=="economy"){
			$_SESSION['price']=850-$fare;
		}
			else {
				$_SESSION['price']=950-$fare;
			}

	  $origin = $_SESSION['from'];
		$dest = $_SESSION['to'];


					$sql = "SELECT * FROM destinations where dest_code='$origin' limit 1";
						$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
						while( $rows = mysqli_fetch_assoc($resultset) ){
								$from = $rows["destination"];
							$_SESSION['start']=$from;}

								$sql = "SELECT * FROM destinations where dest_code='$dest' limit 1";
									$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
									while( $rows = mysqli_fetch_assoc($resultset) ){
											$to = $rows["destination"];
										$_SESSION['stop']=$to;}
	                  $invoice_no = substr(rand().uniqid(), 6, 6); $invoice_no = strtoupper($invoice_no); $_SESSION["invoice_no"] = $invoice_no;
	                  header('Location: book.php');
	} else {
		session_destroy();
		header('Location: book.php?limit='.$all.'&vip='.$vip.'&economy='.$economy.'&route='.$route);
	}



}
if(!empty($_POST["mpesa"])) {
  $sql = "SELECT * FROM bookings WHERE mpesa='" . $_POST["mpesa"] . "'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      echo "<br><span style='color: red;'>Sorry. This code has been used.</span>";
  }else{
      echo "";
  }
}
?>
