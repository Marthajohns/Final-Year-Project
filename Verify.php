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
Verify its You
</h5>
<div class="ml-auto d-flex align-items-center">
<a class="toggle zinnia-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
</div>
</div>

<div class="messenger bg-white shadow-sm p-3 d-flex align-items-center rounded-1 mb-2">
<i class="icofont-user-alt-3 mr-3 h5 mb-0 text-danger"></i>
<input type="text" name="code" class="form-control" placeholder="Enter Work Code">
</div>

<div class="messenger bg-white shadow-sm p-3 d-flex align-items-center rounded-1 mb-2">
<i class="icofont-user-alt-3 mr-3 h5 mb-0 text-danger"></i>
<input type="text" name="password" class="form-control" placeholder="Enter Password">
</div>

<a href=other.php class="btn btn-danger btn-block zinniabus-btn mb-3 rounded-3 mt-4">Verify</a>
 
</div>
</div>
</form>

<?php
include("includes/footerlinks.php");
?>
</body>
</html>