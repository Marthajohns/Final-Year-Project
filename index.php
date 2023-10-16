<?php
require 'processor/units.php';
if( !empty($_SESSION['user_id']) ){
	header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "Beeline - Home";
include("includes/headlinks.php");
?>
</head>
<body>

<div class="zinnia-index bg-c d-flex align-items-center justify-content-center vh-100 index-page">
<div class="text-center">
<a href="landing.php">
<i class="icofont-bus text-white display-1 bg-danger p-4 rounded-circle"></i>
</a><br>
<div class="spinner"></div>
</div>
</div>
<div class="zinnia-fotter fixed-bottom m-3">
<a class="btn btn-block px-4 py-3 d-flex align-items-center zinniabus-btlan btn-danger text-white shadow" href="landing.php">
Get Started <i class="icofont-arrow-right ml-auto"></i>
</a>
</div>

<?php
  include("includes/nav.php");
  include("includes/footerlinks.php");
?>
</body>
</html>
