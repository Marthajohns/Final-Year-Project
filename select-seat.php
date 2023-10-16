<?php
require 'processor/units.php';
$s = $_SESSION['available'];
$date = date("Y-m-d", strtotime($_GET['date']));
$from = $_GET['from'];
$to = $_GET['to'];
$cost = $_GET['cost'];
$vipcost = $_GET['vipcost'];
$company_code = $_GET['company_code'];
$seats = $_GET['seats'];
$left = $_GET['left'];
$time = $_GET['time'];
$bus = $_GET['bus'];
$coach = $_GET['busid'];
$type = $_GET['type'];
$route = $from."-".$to;
$minibus = 30;
$shuttle = 10;
$selectedbus = array("from"=>"$from", "to"=>"$to", "route"=>"$route", "date"=>"$date",
"bus"=>"$bus","company_code"=>"$company_code", "vehicle_type"=>"$type", "time"=>"$time", "cost"=>"$cost", "vipcost"=>"$vipcost" , "busid"=>"$coach");
$_SESSION['selectedbus'] = $selectedbus;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "Beeline";
include("includes/headlinks.php");
$bartit = "Select Seats";
?>
</head>
<body class="bg-light">

<div class="seat-select padding-bt">
<?php
include("includes/togglemenu.php");
?>

<div class="ticket p-3">
<h6 class="mb-1 font-weight-bold text-dark">Travellers ISO 9002- 2022 Certified</h6>
<div class="start-rating f-10 mb-3">
<i class="icofont-star text-danger"></i>
<i class="icofont-star text-danger"></i>
<i class="icofont-star text-danger"></i>
<i class="icofont-star text-danger"></i>
<i class="icofont-star text-muted"></i>
<span class="text-dark">4.0</span>
</div>
<div class="bg-white rounded-1 shadow-sm p-3 mb-3 w-100">
<div class="row mx-0 mb-3">
<div class="col-6 p-0">
<small class="text-muted mb-1 f-10 pr-1">Wifi</small>
<p class="small mb-0 l-hght-14"> Access in the bus</p>
</div>
<div class="col-6 p-0">
<small class="text-muted mb-1 f-10 pr-1">AC</small>
<p class="small mb-0 l-hght-14"> Ac is available</p>
</div>
</div>
<div class="row mx-0 mb-3">
<div class="col-6 p-0">
<small class="text-muted mb-1 f-10 pr-1">Dinner / Lunch</small>
<p class="small mb-0 l-hght-14"> Yes</p>
</div>
<div class="col-6 p-0">
<small class="text-muted mb-1 f-10 pr-1">Safety Features</small>
<p class="small mb-0 l-hght-14"> Sanitized, Masks</p>
</div>
</div>
<div class="row mx-0">
<div class="col-6 p-0">
<small class="text-muted mb-1 f-10 pr-1">Essentials</small>
<p class="small mb-0 l-hght-14"> Pillow, Water</p>
</div>
<div class="col-6 p-0">
<small class="text-muted mb-1 f-10 pr-1">Snacks</small>
<p class="small mb-0 l-hght-14">Juice / shake </p>
<?php echo $date; ?>
</div>
</div>
</div>
<form action="payment.php" method="post">
<div class="select-seat row bg-white mx-0 px-3 pt-3 pb-1 mb-3 rounded-1 shadow-sm">

<div class="col-8 pl-0">
<div class="d-flex">
<div class="sold text-center">
<img src="img/sold-seat.png" class="img-fluid mb-1">
 <p class="small f-10">Sold Out</p>
</div>
<div class="sold text-center mx-3">
<img src="img/available-seat.png" class="img-fluid mb-1">
<p class="small f-10">Available</p>
</div>
<div class="sold text-center">
<img src="img/selected-seat.png" class="img-fluid mb-1">
<p class="small f-10">Selected</p>
</div>
</div>

<div class="select-seat">
<div class="checkboxes-seat mt-4">
	<?php
	foreach (range('A', 'G') as $seatrow){
		?>
		<div class="btn-group btn-group-toggle d-block mb-1" data-toggle="buttons">
			<?php
			for($i = 1; $i<=2; $i++) {
			 ?>
		<label <?php seat_status($seatrow.$i, "bookedalert"); ?> class="btn check-seat <?php seat_status($seatrow.$i, "bookedclass"); ?> small btn-sm rounded mr-2 mb-2">
		<input type="checkbox" name="data[]" value="<?php echo $seatrow.$i; ?>"  <?php seat_status($seatrow.$i, "input"); ?> />
		<?php echo $seatrow.$i; ?>
		</label>
		<?php
		}
			 ?>
		</div>
		<?php
		}
	 ?>
</div>
</div>
</div>
<div class="col-4 text-right pr-0">
<img src="img/driver.png" class="img-fluid mb-4">
<div class="checkboxes-seat mt-4">
	<?php
	foreach (range('A', 'G') as $seatrow){
		?>
		<div class="btn-group btn-group-toggle d-block mb-1" data-toggle="buttons">
			<?php
			$i = 3;
			 ?>
		<label <?php seat_status($seatrow.$i, "bookedalert"); ?> class="btn check-seat <?php seat_status($seatrow.$i, "bookedclass"); ?> small btn-sm rounded mr-2 mb-2">
		<input type="checkbox" name="data[]" value="<?php echo $seatrow.$i; ?>"  <?php seat_status($seatrow.$i, "input"); ?> />
		<?php echo $seatrow.$i; ?>
		</label>
		</div>
		<?php
		}
	 ?>

</div>
</div>
</div>
<div class="list_item d-flex col-12 m-0 p-3 bg-white shadow-sm rounded-1 shadow-sm">
<div class="d-flex mb-auto">
<img src="img/qr-code.png" class="img-fluid zinnia-qr">
</div>
 <div class="d-flex w-100">
<div class="bus_details w-100 pl-3">
<p class="mb-2 l-hght-18 font-weight-bold">More info.</p>
<div class="l-hght-10 d-flex align-items-center my-2">
<small class="text-muted mb-0 pr-1">Passenger</small>
<p class="small mb-0 ml-auto l-hght-14"> Joan Rase</p>
</div>
<div class="l-hght-10 d-flex align-items-center my-2">
<small class="text-muted mb-0 pr-1">Ticket Number</small>
<p class="small mb-0 ml-auto l-hght-14"> 1313</p>
</div>
<div class="l-hght-10 d-flex align-items-center my-2">
<small class="text-muted mb-0 pr-1">PNR Number</small>
<p class="small mb-0 ml-auto l-hght-14"> 56276-32324</p>
</div>
<div class="l-hght-10 d-flex align-items-center mt-3">
<p class="mb-0 pr-1 font-weight-bold">Amount Paid</p>
<p class="mb-0 ml-auto l-hght-14 text-danger font-weight-bold">$700</p>
</div>
</div>
</div>
</div>
</div>
</div>
<input type="hidden" id="fare" value="<?php echo $cost; ?>" />
<input type="hidden" id="selseats" name="selseats" />
<input type="hidden" id="tcost" name="tcost" />
<input type="hidden" name="seat" value="seat" />
<div class="fixed-bottom view-seatbt p-3">
<button type="submit" id="submit" onlc class="btn btn-danger btn-block d-flex align-items-center zinniabus-btn rounded-1">
<span class="text-left l-hght-14">
TOTAL KSH <span id="cashtotal">0</span><br>
<small class="f-10 text-white-50">Seats Selected : <span id="noseats">0</span></small>
</span>
<span class="font-weight-bold ml-auto">NEXT</span>
</button>
</div>
</form>
<?php
  include("includes/nav.php");
  include("includes/footerlinks.php");
?>
<script>
function booked() {
alert("This seat has been taken! Please pick another one.");
}
$(document).ready(function(){

$(".btn-success").click(function () {
	setTimeout(function(){
		var Selected = $('.btn-success.active').length;
		var cost = $("#fare").val();
		var tcost = cost*Selected;
		$("#selseats").val(Selected);
		$("#noseats").html(Selected);
		$("#tcost").val(tcost);
		$("#cashtotal").html(tcost);
}, 1000);
});
$("#submit").click(function (e) {
		var Selected = $('.btn-success.active').length;
		if (Selected == 0) {
        e.preventDefault();
        alert("Please choose at least one seat to proceed ");
    }
});

});
</script>
</body>
</html>
