<?php
require 'processor/units.php';
if( !empty($_SESSION['user_id']) ){

	$records = $db->prepare('SELECT * FROM users WHERE id = :id');
    $seid = $_SESSION['user_id'];
	$records->bindParam(':id', $seid );
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}

}
$s = $_SESSION['available'];
$route = explode('-', $_GET['route']);
$date = date("D, d M", strtotime($_GET['date']));
$from = $route[0];
$to = $route[1];

$minibus = 30;
$shuttle = 10;
$Bus = 60;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "BeeLine - Listings";
include("includes/headlinks.php");
$bartit = "Vehicle Listing";
?>
</head>
<body class="bg-light">
<?php
    //var_dump($s);
    ?>
<div class="zinnia-listing">
<?php
include("includes/togglemenu.php");
?>
<div class="zinnia-listing p-0 m-0 row border-top">
<div class="p-2 border-bottom w-100">
<div class="bg-white border border-warning rounded-1 shadow-sm p-2">
<div class="row mx-0 px-1">
<div class="col-4 p-0">
<small class="text-muted mb-1 f-10 pr-1">GOING FROM</small>
<p class="small mb-0"> <?php echo strtoupper($from); ?></p>
</div>
<div class="col-4 p-0">
<small class="text-muted mb-1 f-10 pr-1">GOING TO</small>
<p class="small mb-0"> <?php echo strtoupper($to); ?></p>
</div>
    <div class="col-4 p-0">
<small class="text-muted mb-1 f-10 pr-1">DATE</small>
<p class="small mb-0"> <?php echo strtoupper($date); ?></p>
</div>
</div>
</div>
</div>

    <?php
    if (count($s) === 0) {
     echo '<div class="container ml-5 pl-5"><h3 class="text-danger text-center mt-5">No vehicles found</h3></div>';
} else{
    foreach($s as $entry) {
        $vehicle_type =  $entry['vehicle_type'];
        if($vehicle_type == "minibus"){
            $seats = $minibus;
        }elseif($vehicle_type == "shuttle"){
            $seats = $shuttle;
        }
        elseif($vehicle_type == "Bus"){
            $seats = $Bus;
        }
        ?>
    <a href="select-seat.php?to=<?php echo $to; ?>&from=<?php echo $from; ?>&date=<?php echo $date; ?>&cost=<?php echo $entry['cash']; ?>&company_code=<?php echo $entry['company_code']; ?>&vipcost=<?php echo $entry['VIPcash']; ?>&seats=<?php echo $seats; ?>&left=<?php echo $seats -$entry['count']; ?>
			&bus=<?php echo $entry['company_code']; ?>&type=<?php echo $vehicle_type; ?>
			&busid=<?php echo  $entry['busid']; ?>&time=<?php echo  $entry['time']; ?>" class="text-dark col-6 px-0">
<div class="list_item_gird m-0 bg-white shadow-sm listing-item border-bottom border-right">
<div class="px-3 pt-3 tic-div">
<div class="list-item-img">
<img src="img/listing/item1.png" class="img-fluid">
</div>
<p class="mb-0 l-hght-10"><?php echo $entry['company_code']; ?> - <span class="text-success"><?php echo $seats -$entry['count']; ?> Seats left</span></p>
<span class="text-danger small"><?php echo $from; ?> to <?php echo $to; ?></span>
<div class="start-rating small">
<i class="icofont-star text-danger"></i>
<i class="icofont-star text-danger"></i>
<i class="icofont-star text-danger"></i>
<i class="icofont-star text-danger"></i>
<i class="icofont-star text-muted"></i>
<span class="text-dark">4.0</span>
</div>
</div>
<div class="p-3 d-flex">
<div class="bus_details w-100">
<div class="d-flex">
<p><i class="icofont-bus-alt-2 mr-2 text-danger"></i><span class="small"><?php echo $entry['vehicle_type']." (".$seats." Seater)"; ?></span></p>
</div>
<div class="d-flex l-hght-10">
<span class="icofont-clock-time small mr-2 text-danger"></span>
<div>
<small class="text-muted mb-2 d-block">Journey Start</small>
<p class="small"><?php echo $date; ?>, <?php echo date("h:i a",strtotime($entry['time'])); ?></p>
</div>
</div>
<div class="d-flex l-hght-10">
<span class="icofont-bill-alt small mr-2 text-danger"></span>
    <div>
<small class="text-muted mb-2 d-block">Cost in Kenyan Shilling</small>
<p class="small"><b>Economy:</b> KSH <?php echo $entry['cash']; ?></p>
<p class="small"><b>VIP:</b> KSH <?php echo $entry['VIPcash']; ?></p>
</div>
</div>
</div>
</div>
</div>
</a>

    <?php
    }
    }
    ?>

</div>
</div>

<div class="modal fade" id="filterModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog m-0">
<div class="modal-content modal-content rounded-0 border-0 vh-100">
<form>
<div class="zinnia-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
<h5 class="font-weight-normal mb-0 text-white">
<a data-dismiss="modal" aria-label="Close" class="text-danger"><i class="icofont-rounded-left mr-3"></i></a>
Filter By
</h5>
<div class="ml-auto d-flex align-items-center">
<a href="#" class="text-white mr-3">Clear all</a>
<a class="toggle zinnia-toggle h4 m-0 text-white ml-auto hc-nav-trigger hc-nav-1" href="#" role="button" aria-controls="hc-nav-1"><i class="icofont-navigation-menu"></i></a>
</div>
</div>
<div class="modal-body p-3">
<div class="mb-4">
<div class="d-flex">
<p class="mb-2 text-dark font-weight-bold">Choose Class</p>
</div>
<div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="customRadioclass1" name="customRadioclass1" class="custom-control-input">
<label class="custom-control-label small" for="customRadioclass1">AC</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="customRadioclass2" name="customRadioclass1" class="custom-control-input">
<label class="custom-control-label small" for="customRadioclass2">Non AC</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="customRadioclass3" name="customRadioclass1" class="custom-control-input">
<label class="custom-control-label small" for="customRadioclass3">Business</label>
</div>
</div>
<div class="mb-4">
<p class="mb-2 text-dark font-weight-bold">Choose Price</p>
<div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="customRadioprice1" name="customRadioprice1" class="custom-control-input">
<label class="custom-control-label small" for="customRadioprice1">$100 - $200</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="customRadioprice2" name="customRadioprice1" class="custom-control-input">
<label class="custom-control-label small" for="customRadioprice2">$300 - $400</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="customRadioprice3" name="customRadioprice1" class="custom-control-input">
<label class="custom-control-label small" for="customRadioprice3">$600 - $800</label>
</div>
</div>
<div class="mb-4">
<p class="mb-2 text-dark font-weight-bold">Choose Bus Service</p>
<div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
<label class="btn btn-chkftr btn-danger small btn-sm rounded mr-2 mb-2">
<input type="checkbox" name="options" autocomplete="off"> Niloy Poribohon
</label>
<label class="btn btn-chkftr btn-danger small btn-sm rounded mr-2 mb-2">
<input type="checkbox" name="options" autocomplete="off"> Green Wheel
</label>
<label class="btn btn-chkftr btn-danger small btn-sm rounded mr-2 mb-2">
<input type="checkbox" name="options" autocomplete="off"> Parboti Bus
</label>
<label class="btn btn-chkftr btn-danger small btn-sm rounded mr-2 mb-2">
<input type="checkbox" name="options" autocomplete="off"> Night Way
</label>
</div>
</div>
</div>
<div class="modal-footer border-0 fixed-bottom">
<button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger btn-block zinniabus-btn py-3">APPLY FILTER</button>
</div>
</form>
</div>
</div>
</div>

<?php
    include("includes/nav.php");
include("includes/footerlinks.php");
?>
</body>

</html>
