<?php
require 'processor/units.php';
$invoice_no = substr(rand().uniqid(), 6, 6); $invoice_no = strtoupper($invoice_no);
$details = $_SESSION['selectedbus'];
$addeddetails = array("ticketno"=>"$invoice_no", "seatsselect"=>"$seatsselect", "totalcost"=>"$totalcost", "selseats"=>"$selseats");
$_SESSION['checkout'] = array_merge($details,$addeddetails);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "Beeline";
include("includes/headlinks.php");
$bartit = "Payment Page";
?>
</head>
<body class="bg-light">

<div class="payment padding-bt">
<?php
include("includes/togglemenu.php");
?>

<div class="your-ticket pt-2">
<div class="p-3">
<div class="bg-white rounded-1 shadow-sm p-2 mb-2">
<div class="row mx-0 px-1">
<div class="col-6 p-0">
<small class="text-muted mb-1 f-10 pr-1">GOING FROM</small>
<p class="small mb-0"> <?php echo $_SESSION['checkout']['from']; ?></p>
</div>
<div class="col-6 p-0">
<small class="text-muted mb-1 f-10 pr-1">GOING TO</small>
<p class="small mb-0"> <?php echo $_SESSION['checkout']['to']; ?></p>
</div>
</div>
</div>
<div class="bg-white rounded-1 shadow-sm p-2 mb-2 w-100">
<div class="row mx-0 px-1">
<div class="col-12 p-0 mb-2">
<small class="text-danger mb-1 f-10 pr-1">PICKUP FROM</small>
<p class="small mb-0 l-hght-14"> <?php echo $_SESSION['checkout']['from']; ?> - <?php echo date("h:i:a", (int)$_SESSION['checkout']['time']); ?></p>
</div>
<div class="col-12 p-0">
<small class="text-danger mb-1 f-10 pr-1">DROPPING AT</small>
<p class="small mb-0 l-hght-14"><?php echo $_SESSION['checkout']['to']; ?></p>
</div>
</div>
</div>

<div class="list_item d-flex col-12 m-0 p-3 bg-white shadow-sm rounded-1 shadow-sm">
<div class="d-flex w-100">
<div class="bus_details w-100">
<p class="mb-2 l-hght-18 font-weight-bold">Traveller’s Info.</p>
<div class="l-hght-10 d-flex align-items-center my-2">
<small class="text-muted mb-0 pr-1">Passenger</small>
<p class="small mb-0 ml-auto l-hght-14"> <?php echo $user["name"]; ?></p>
</div>
<div class="l-hght-10 d-flex align-items-center my-2">
<small class="text-muted mb-0 pr-1">Ticket Number</small>
<p class="small mb-0 ml-auto l-hght-14"> <?php echo $_SESSION['checkout']['ticketno']; ?></p>
</div>
<div class="l-hght-10 d-flex align-items-center my-2">
<small class="text-muted mb-0 pr-1">Seat No</small>
<p class="small mb-0 ml-auto l-hght-14"> <?php echo $_SESSION['checkout']['seatsselect']; ?></p>
</div>
<div class="l-hght-10 d-flex align-items-center mt-3">
<p class="mb-0 pr-1 font-weight-bold">Amount Paid</p>
<p class="mb-0 ml-auto l-hght-14 text-danger font-weight-bold">KSH <?php echo $totalcost; ?></p>
</div>
</div>
</div>
</div>

<div class="payment-borrad shadow-sm bg-white mt-2 rounded-1">
<div class="border-bottom p-3">
<div class="w-100 mastercard custom-control custom-radio custom-control-inline mr-0">
<input type="radio" id="customRadiomaster1" name="customRadiocard1" class="custom-control-input" checked>
<label class="custom-control-label small w-100" for="customRadiomaster1">
<a href="payment-card.php" class="d-flex align-items-start">
<div class="">
<p class="mb-0 text-dark">M-Pesa Express</p>
<small class="text-muted">Pay from M-Pesa account through M-Pesa payment gateway</small>
</div>
<img src="img/mpesa.png" class="img-fluid rounded ml-auto">
</a>
</label>
</div>
</div>
</div>
</div>

</div>
</div>
<div class="fixed-bottom view-seatbt p-3">
<a href="payment-card.php" class="btn btn-danger btn-block d-flex align-items-center zinniabus-btn rounded-1">
<span class="text-left l-hght-14">
TOTAL KSH <?php echo $totalcost; ?><br>
<small class="f-10 text-white-50">Seats Selected : <?php echo $selseats; ?></small>
</span>
<span class="font-weight-bold ml-auto">CONFIRM</span>
</a>
</div>

<?php
  include("includes/nav.php");
  include("includes/footerlinks.php");
?>
</body>
</html>
