<?php
session_start();
include ("db.php");
$info = "";
if(isset($_POST['cancel']))
{   $ticket = $_POST["ticket"];
	$sql = "SELECT * FROM bookings where invoice='$ticket'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while( $row = mysqli_fetch_assoc($result) ){$dot = $row['travel_date'];}
		$date = new DateTime($dot);
    $now = new DateTime();
     if($date < $now) {
         $info = '<p style="color: red">Sorry. The ticket already expired. The date of travel is passed</p>';
			 } else{
				 $sql = mysqli_query($conn, "DELETE FROM bookings WHERE invoice='$ticket'");
		 		$sql2 = mysqli_query($conn, "DELETE FROM seats WHERE ticket='$ticket'");
		 		$info = '<p style="color: green">Ticket successfully cancelled. You shall recieve your money through M-Pesa shortly, we have deducted 2% for the reverse transaction cost.</p>';

			 }

} else {$info = '<p style="color: red">The Ticket Number is not correct.</p>';}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cancel Ticket</title>
		<link rel="stylesheet" href="css/style.css">
		 <link rel="stylesheet" href="css/mob.css">
		 <link rel="stylesheet" href="css/bootstrap.css">
		 <link rel="stylesheet" href="css/materialize.css" />
		 <script src="js/jquery.min.js"></script>
	</head>
	<body><br><br><br>

		<?php include ('includes/navbar.php');?>
<div class="container">
   <div class="row">
    <div class="col-md-4">

		</div>
		<div class="col-md-4">
			<p>Please submit the ticket number that you wish to cancel</p><br>
			<?php echo $info; ?>
			<form class="form-group " action="" method="post">
				<div class="form-group">
			<input type="text" name="ticket" class="form-control" placeholder="Enter Ticket Number" style="width: 200px;" required>
			</div>
					 <div class="form-group">
					<input type="submit" name="cancel" class="btn btn-sm btn-danger" value="Cancel ticket">
					</div>
				</form>
		</div>
		<div class="col-md-4">

		</div>
	 </div>
</div>

</body>
</html>
