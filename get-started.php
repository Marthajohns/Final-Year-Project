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
$title = "BeeLine - Get Started";
include("includes/headlinks.php");
?>
</head>
<body>

<div class="py-4 d-flex align-items-center justify-content-center">
<div class="zinnia-started pt-2 text-center">
<img src="img/sign-in-pana.svg" class="img-fluid mb-2 col-9 mx-auto">
<div class="head py-4 px-4 text-center">
<h5 class="font-weight-bold mb-4">Start by creating an account.</h5>
<p class="text-muted">I'm an early bird and I'm night owl so I'm<br>wise and I have worms.</p>
</div>
<div class="fixed-bottom p-4">
<a href="signup.php" class="btn btn-block btn-danger mb-3 zinniabus-btn">CREATE AN ACCOUNT</a>
<a href="signin.php" class="btn btn-block btn-light zinniabus-btn">SIGN IN</a>
</div>
</div>
</div>


<?php
include("includes/footerlinks.php");
?>
</body>
</html>
