<?php
require 'processor/units.php';
if( !empty($_SESSION['user_id']) ){
	//header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "BeeLine - Landing Page";
include("includes/headlinks.php");
?>
</head>
<body>

<div class="landing-page bg-danger">
<div class="zinnia-slider m-0">
<div class="zinnia-slider-item text-center">
<div class="d-flex align-items-center justify-content-center vh-100 flex-column">
<i class="icofont-globe display-3 text-white"></i>
<h5 class="mt-4 mb-3 text-white">Book your bus, shuttle or taxi online</h5>
<p class="text-center text-white-50 mb-5 px-4">You can always get all you want on your soffa, Trust us.</p>
</div>
</div>
<div class="zinnia-slider-item text-center bg-white">
<div class="d-flex align-items-center justify-content-center vh-100 flex-column">
<i class="icofont-bus display-3 text-danger"></i>
<h5 class="mt-4 mb-3 text-danger">Digital Journey Tracking System</h5>
<p class="text-center text-dark-50 mb-5 px-4">Wanna see where you are at, Please dont bother sleepy head neighbour.</p>
</div>
</div>
<div class="zinnia-slider-item text-center">
<div class="d-flex align-items-center justify-content-center vh-100 flex-column">
<i class="icofont-notification display-3 text-white"></i>
<h5 class="mt-4 mb-3 text-white">Get to speak out important issues as you travel</h5>
<p class="text-center text-white-50 mb-5 px-4">Thanks to our Advanced accident and crime reporting system.</p>
</div>
</div>
</div>
</div>

<div class="zinnia-fotter fixed-bottom m-3">
<a href="get-started.php" class="btn bg-white text-danger border-danger btn-block zinniabus-btlan">Get Started</a>
</div>

<?php
include("includes/footerlinks.php");
?>
</body>

</html>
