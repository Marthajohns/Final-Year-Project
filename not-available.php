<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "Beeline";
include("includes/headlinks.php");
?>
</head>
<body>

<div class="vh-100 zinnia-coming-soon p-4 d-flex justify-content-center align-items-center">
<div class="zinnia-text text-center">
<div class="zinnia-img px-3 pb-1">
<img src="img/no-buus.svg" class="img-fluid mb-1">
</div>
<h2 class="mb-3 font-weight-bold text-danger">Not Available</h2>
<p class="lead small mb-0">No bus found for selected dates or cities.</p>
<p class="mb-5">If you think this is a problem with us, please <a class="text-danger" href="support">tell us</a>.</p>
<a href="home.php" class="btn btn-danger px-5 zinniabus-btn rounded-1 mt-4">Go Back</a>
</div>
</div>

<?php
include("includes/footerlinks.php");
?>
</body>
</html>