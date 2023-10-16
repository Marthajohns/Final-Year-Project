<?php
require 'processor/units.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "BeeLine";
include("includes/headlinks.php");
$bartit = "Your Ticket";
?>
<script
			src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
			integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		></script>
</head>
<body class="bg-light">

<div class="ticket padding-bt">
<?php
include("includes/togglemenu.php");
?>

<div class="your-ticket p-3"id="generatePDF">
<h5 class="mb-3 font-weight-bold text-dark">BeeLine Travellers ISO 2013- 2023 Certified</h5>
<p class="text-success mb-3 font-weight-bold">COMPLETED</p>
<div class="bg-white border border-warning rounded-1 shadow-sm p-3 mb-3">
<div class="row mx-0 mb-3">
<div class="col-6 p-0">
<small class="text-muted mb-1 f-10 pr-1">GOING FROM</small>
<p class="small mb-0 l-hght-14"> <?php echo $_SESSION['checkout']['from']; ?></p>
</div>
<div class="col-6 p-0">
<small class="text-muted mb-1 f-10 pr-1">GOING TO</small>
<p class="small mb-0 l-hght-14"> <?php echo $_SESSION['checkout']['to']; ?></p>
</div>
</div>
<div class="row mx-0">
<div class="col-6 p-0">
<small class="text-muted mb-1 f-10 pr-1">DATE OF JOURNEY</small>
<p class="small mb-0 l-hght-14"> <?php echo date("d M Y", strtotime($_SESSION['checkout']['date'])); ?></p>
</div>
<div class="col-6 p-0">
<small class="text-muted mb-1 f-10 pr-1">YOU RATED</small>
<p class="small mb-0 l-hght-14"><span class="icofont-star text-warning"></span> 3.5</p>
</div>
</div>
</div>
<div class="bg-white rounded-1 shadow-sm p-3 mb-3 w-100">
<div class="row mx-0">
<div class="col-12 p-0 mb-3">
<small class="text-danger mb-1 f-10 pr-1">PICKUP FROM</small>
<p class="small mb-0 l-hght-14"> <?php echo $_SESSION['checkout']['from']; ?> - <?php echo date("h:i a",strtotime($_SESSION['checkout']['time'])); ?></p>
</div>
<div class="col-12 p-0">
<small class="text-danger mb-1 f-10 pr-1">DROPPING AT</small>
<p class="small mb-0 l-hght-14"><?php echo $_SESSION['checkout']['to']; ?></p>
</div>
</div>
</div>
<div class="list_item d-flex col-12 m-0 p-3 bg-white shadow-sm rounded-1 shadow-sm mb-3">
<div class="d-flex mb-auto">
<span class="icofont-location-pin h4"></span>
</div>
<div class="d-flex w-100">
<div class="bus_details w-100 pl-3">
<p class="mb-2 l-hght-18 font-weight-bold">View Boarding Location on Map</p>
<div class="d-flex align-items-center mt-2">
 <small class="text-muted mb-0 pr-1"><?php echo $_SESSION['checkout']['from']; ?><br> Town, Kenya <br>560016
</small>
</div>
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
<p class="small mb-0 ml-auto l-hght-14"> <?php echo $user['name']; ?></p>
</div>
<div class="l-hght-10 d-flex align-items-center my-2">
<small class="text-muted mb-0 pr-1">Ticket Number</small>
<p class="small mb-0 ml-auto l-hght-14"> <?php echo $_SESSION['checkout']['ticketno']; ?></p>
</div>
<div class="l-hght-10 d-flex align-items-center my-2">
<small class="text-muted mb-0 pr-1">PNR Number</small>
<p class="small mb-0 ml-auto l-hght-14"> 56276-32324</p>
</div>
<div class="l-hght-10 d-flex align-items-center mt-3">
<p class="mb-0 pr-1 font-weight-bold">Amount Paid</p>
<p class="mb-0 ml-auto l-hght-14 text-danger font-weight-bold">KSH <?php echo $_SESSION['checkout']['totalcost']; ?></p>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="fixed-bottom p-3">
<div class="footer-menu row m-0 px-1 bg-white shadow rounded-2">
<div class="col-4 p-0 text-center"></div>
<div class="col-4 p-0 text-center">
<a id="pdfButton" class="home text-danger py-3">
<span class="icofont-file-pdf h5"></span>
<p class="mb-0 small">Download Pdf</p>
</a>
</div>
<div class="col-4 p-0 text-center"></div>
</div>
</div>

<?php
  include("includes/nav.php");
  include("includes/footerlinks.php");
?>
<script>
      const button = document.getElementById('pdfButton');

			function generatePDF() {
				const element = document.getElementById('generatePDF');
				html2pdf().from(element).save();
			}

			button.addEventListener('click', generatePDF);
   </script>
</body>
</html>
