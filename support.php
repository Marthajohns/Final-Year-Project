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
$title = "Beeline";
include("includes/headlinks.php");
?>
</head>
<body class="bg-light">

<div class="zinnia-support">
<div class="zinnia-header-nav shadow-sm bg-danger p-3 d-flex align-items-center">
<h5 class="font-weight-normal mb-0 text-white">
<a class="text-danger mr-3" href="home.php"><i class="icofont-rounded-left"></i></a>
Support
</h5>
<div class="ml-auto d-flex align-items-center">
<a class="toggle zinnia-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
</div>
</div>
 s
<div class="px-3 py-4">
<p class="text-muted small">We are here to help you with any information and problems through our contact center</p>
<div class="messenger bg-white shadow-sm p-3 d-flex align-items-center rounded-1 mb-2">
<i class="icofont-ui-messaging mr-3 h5 mb-0 text-danger"></i>
<input type="email" name="email" class="form-control" placeholder="Report Message">
</div>

<div class="messenger bg-white shadow-sm p-3 d-flex align-items-center rounded-1 mb-2">
<i class="icofont-ui-email mr-3 h5 mb-0 text-danger"></i>
<input type="email" value="<?php echo $user["email"]; ?>" name="email" class="form-control" readonly>
</div>

<!--a href="sent.php" class="btn btn-danger btn-block zinniabus-btn mb-3 rounded-1 mt-4">SEND MESSAGE</a-->
</div>
</div>

<?php
include("includes/footerlinks.php");
?>
</body>
</html>