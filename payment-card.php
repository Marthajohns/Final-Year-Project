<?php
require 'processor/units.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "Beeline";
include("includes/headlinks.php");
$bartit = "M-Pesa Payment";
?>
</head>
<body class="bg-light">

<div class="payment">
<?php
include("includes/togglemenu.php");
?>

<div class="your-ticket p-3">
<div class="list_item d-flex rounded-1 col-12 m-0 bg-white shadow-sm mb-3">
<div class="pt-3 d-flex mb-auto">
<img src="img/qr-code.png" class="img-fluid zinnia-qr">
</div>
<div class="pl-3 py-3 d-flex w-100">
<div class="bus_details w-100">
<p class="mb-2 l-hght-18 font-weight-bold"><?php echo $user['name']; ?></p>
<div class="l-hght-10 d-flex align-items-center my-2">
<small class="text-muted mb-0 pr-1">Journey Start</small>
<p class="small mb-0 l-hght-14 ml-auto"><?php echo date("d M y", strtotime($_SESSION['checkout']['date'])); ?>, <?php echo date("h:i a",strtotime($_SESSION['checkout']['time'])); ?></p>
</div>
<div class="l-hght-10 d-flex align-items-center my-2">
<small class="text-muted mb-0 pr-1">From - To</small>
<p class="small mb-0 l-hght-14 ml-auto"><?php echo $_SESSION['checkout']['from']; ?> to <?php echo $_SESSION['checkout']['to']; ?></p>
</div>
<div class="l-hght-10 d-flex align-items-center my-2">
<small class="text-muted mb-0 pr-1">Pickup Point</small>
<p class="small mb-0 l-hght-14 ml-auto"><?php echo $_SESSION['checkout']['from']; ?>(<?php echo date("h:i a",strtotime($_SESSION['checkout']['time'])); ?>)</p>
</div>
<div class="l-hght-10 d-flex align-items-center mt-2">
<small class="text-muted mb-0 pr-1">Seat No.</small>
<p class="small mb-0 l-hght-14 ml-auto"><?php echo $_SESSION['checkout']['seatsselect']; ?></p>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="payment-borrad shadow bg-white m-3 rounded-1 p-3">
<div class="d-flex small">
<p>Total Payable KSH</p>
<p class="ml-auto font-weight-bold text-danger">KSH <?php echo $_SESSION['checkout']['totalcost']; ?></p>
</div>
<div class="d-flex small">
  <div class="w-100">
<?php
   include("processor/mpesa-express.php");
 ?>
</div>
</div>
</div>

<div class="modal fade" id="paymentModal" data-backdrop="static" tabindex="-1" data-keyboard="false">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content mx-4 rounded-2">
<div class="modal-header d-none">
</div>
<div class="modal-body text-center py-4">
<img src="img/valid.png" class="img-fluid mb-2">
<h5 class="font-weight-normal">Payment Success!</h5>
<p class="mb-4">The system is waiting for the<br>the ticket</p>
<a href="your-ticket.php" class="btn btn-sm btn-danger">Check Your Ticket</a>
</div>
<div class="modal-footer d-none">
</div>
</div>
</div>
</div>

<?php
  include("includes/nav.php");
  include("includes/footerlinks.php");
?>
<script>
window.onload = function(){
  <?php if(!empty($_GET['phone'])){
    echo "document.forms['mpesa'].submit();
    $('#payref').html('Please wait...');
    $('#payref').attr('disabled', true);";
  } ?>

}
$(document).ready(function(){

 $("#pesanum").keyup(function(){
  $("#payref").attr("href", "payment-card.php?phone="+$("#pesanum").val());
});

$("#payref").click(function (e) {
		var mpes = $("#pesanum").val();
		if (!mpes) {
        e.preventDefault();
        alert("Please enter M-Pesas number ");
    }
});
<?php
if (!empty($_GET["afd"])) {
	$val = "iluos";
	$val1 = $_GET["id"];
	$val2 = $_GET["ivm"];
	$val3 = $_GET["qwh"];
	$val4 = $_GET["afd"];
	$val5 = $_GET["poi"];
	$val6 = $_GET["uyt"];
	$val7 = $_GET["ifd"];

	$ipnurl = "https://www.ipayafrica.com/ipn/?vendor=".$val."&id=".$val1."&ivm=".
	$val2."&qwh=".$val3."&afd=".$val4."&poi=".$val5."&uyt=".$val6."&ifd=".$val7;
	$fp = fopen($ipnurl, "rb");
	$status = stream_get_contents($fp, -1, -1);

	if($status = "aei7p7yrx4ae34"){
		 $checkout = $_SESSION['checkout'];
		 $checkout = implode(",", $checkout);
		 $checkbox = $_SESSION['singles'];
		 $date = $_SESSION['checkout']['date'];
      	 $ticket = $_SESSION['checkout']['ticketno'];
         $class = "Economy";
         $route = $_SESSION['checkout']['route'];
         $busid = $_SESSION['checkout']['busid'];
         $vehicle_type = $_SESSION['checkout']['vehicle_type'];
		mysqli_query($conn,"insert into booking (data) values ('".$checkout."')") or die(mysqli_error($conn));
		for($i=0;$i<count($checkbox);$i++){
      $check_id = $checkbox[$i];
      mysqli_query($conn,"insert into seats (date, seatno, ticket, class, route, vehicle_type, busid) values ('$date', '".$check_id."', '$ticket', '$class', '$route', '$vehicle_type', '$busid')") or die(mysqli_error($conn));
      }
    $_SESSION['Payment'] = 'Success';
	    echo "window.location.href = 'your-ticket.php';";

	}elseif($status = "fe2707etr5s4wq"){
	    echo "alert(payment not successful!)";

	}
	elseif($status = "bdi6p2yy76etrs"){
		echo "alert(payment not successful!)";

	}
	elseif($status = "cr5i3pgy9867e1"){
		echo "alert(payment not successful!)";

	}
	elseif($status = "dtfi4p7yty45wq"){
		echo "alert(payment not successful!)";

	}
	elseif($status = "eq3i7p5yt7645e"){
		echo "alert(payment not successful!)";

	}
	fclose($fp);
}
 ?>
});
</script>
</body>
</html>
