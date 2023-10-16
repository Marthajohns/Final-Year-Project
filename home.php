<?php
require 'processor/units.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "BeeLine - Home";
include("includes/headlinks.php");
$bartit = "Beeline Home";
?>
</head>
<body class="bg-light">

<div class="zinnia-verification padding-bt">
<?php
include("includes/togglemenu.php");
?>
<div class="bg-danger px-3 pb-3">
<div class="bg-white rounded-1 p-3">
<form method="post" action="processor/no-ajax.php">
<div class="form-group border-bottom pb-2">
<label for="exampleFormControlSelect1" class="mb-2"><span class="icofont-search-map text-danger"></span> From</label><br>
<select id="from_select" class="js-example-basic-single form-control" name="origin" required>
<option value="">--Select--</option>
<?php
			      $sql = "SELECT * FROM destinations";
				    $result = mysqli_query($conn, $sql);
			      if (mysqli_num_rows($result) > 0) {
							while( $row = mysqli_fetch_assoc($result) ){
			echo '<option value="'.$row['destination'].'">'.$row['destination'].'</option>';
						}
			    	} ?>
</select>
</div>
<div class="form-group border-bottom pb-2">
<label for="exampleFormControlSelect1" class="mb-2"><span class="icofont-google-map text-danger"></span> To</label><br>
<select id="to_select" class="js-example-basic-single form-control" name="destination" required>
<option value="">--Select--</option>
						<?php
					$sql = "SELECT * FROM destinations";
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result) > 0) {
						while( $row = mysqli_fetch_assoc($result) ){
			echo '<option value="'.$row['destination'].'">'.$row['destination'].'</option>';
					}
					} ?>
</select>
</div>
<div class="form-group border-bottom pb-1">
<label for="exampleFormControlSelect1" class="mb-2"><span class="icofont-ui-calendar text-danger"></span> Date</label><br>
<input name="travel_date" id="datefield" class="form-control border-0 p-0" type="date" min='2022-30-09' max='3000-13-13' required>
</div>
<input type="hidden" name="check_seats" value="check_seats" />
<button type="submit" class="btn btn-danger btn-block zinniabus-btn rounded-1">Search</button>
</form>
</div>
</div>
<div class="p-3 bg-warning">
<div class="row m-0">
<div class="col-6 py-1 pr-1 pl-0">
<div class="p-3 bg-white shadow-sm rounded-1">
<img class="img-fluid" src="img/safe-vehicles.svg" alt="">
<p class="mb-0 mt-4 font-weight-bold"><a href="customer-feedback.php">Rate Your<br>Journey</p></a>
</div>
</div>
<div class="col-6 py-1 pl-1 pr-0">
<div class="p-3 bg-white shadow-sm rounded-1">
<img class="img-fluid" src="img/customer-support.svg" alt="">
<p class="mb-0 mt-4 font-weight-bold">Speak To One<br>Of Us</p>
</div>
</div>
<div class="col-6 py-1 pr-1 pl-0">
<div class="p-3 bg-white shadow-sm rounded-1">
<img class="img-fluid" src="img/live-tracking.svg" alt="">
<p class="mb-0 mt-4 font-weight-bold"><a href="location.php">See Where You<br>Are</p></a>
</div>
</div>
<div class="col-6 py-1 pl-1 pr-0">
<div class="p-3 bg-white shadow-sm rounded-1">
<img class="img-fluid" src="img/slippery-road-icon.svg" width="73" height="50" alt="">
<p class="mb-0 mt-4 font-weight-bold"><a href="report-accidents.php">Report Accidents<br>and Fraud</p></a>
</div>
</div>
</div>
				</div>

<?php
  include("includes/nav.php");
  include("includes/footerlinks.php");
?>
</body>

</html>
