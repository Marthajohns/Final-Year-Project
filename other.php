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
//$s = $_SESSION['available'];
//$route = explode('-', $_GET['route']);
//$date = date("D, d M", strtotime($_GET['date']));
//$from = $route[0];
//$to = $route[1];

$minibus = 30;
$shuttle = 10;
$Bus = 60;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "Beeline";
include("includes/headlinks.php");
?>
</head>

<body class="bg-light">
<p id=address></p>
<div class="zinnia-support">
<div class="zinnia-header-nav shadow-sm bg-danger p-3 d-flex align-items-center">
<h5 class="font-weight-normal mb-0 text-white">
<a class="text-danger mr-3" href="home.php"><i class="icofont-rounded-left"></i></a>
OTHER PAGES - Pick Your Verified Viewing Page
</h5>
<div class="ml-auto d-flex align-items-center">
<a class="toggle zinnia-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
</div>
</div>


<a href="Bookings.php" class="btn btn-info btn-block zinniabus-btn mb-3 rounded-3 mt-4">BOOKINGS</a>
<a href="Reviews.php" class="btn btn-basic btn-block zinniabus-btn mb-3 rounded-3 mt-4">RATINGS AND REVIEWS</a>
<a href="Police.php" class="btn btn-warning btn-block zinniabus-btn mb-3 rounded-3 mt-4">PASSENGER REPORT</a>
</div>
</div>
</form>

<?php
include("includes/footerlinks.php");
?>
</body>
</html>