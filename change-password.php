<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "Beeline - Change Password";
include("includes/headlinks.php");
?>
</head>
<body class="bg-light">

<div class="zinnia-giftcard">
<div class="zinnia-header-nav bg-danger p-3 d-flex align-items-center">
<h5 class="font-weight-normal mb-0 text-white">
<a class="text-danger mr-3" href="home"><i class="icofont-rounded-left"></i></a>
Change Password
</h5>
<div class="ml-auto d-flex align-items-center">
<a class="toggle zinnia-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
</div>
</div>
<div class="px-3 py-4">
<form action="verification">
<div class="form-group">
<label class="text-muted f-10 mb-1">Old Password</label>
<input type="password" class="form-control" placeholder="Enter Your Password" value="zinnia94">
</div>
<div class="form-group">
<label class="text-muted f-10 mb-1">New Password</label>
<input type="password" class="form-control" placeholder="Enter Your Password" value="zinnia94">
</div>
<div class="form-group">
<label class="text-muted f-10 mb-1">Confirm Password</label>
<input type="password" class="form-control" placeholder="Enter Your Password" value="zinnia94">
</div>
<a href="verification.php" class="btn btn-danger btn-block zinniabus-btn rounded-1 mt-4">CHANGE PASSWORD</button></a>
</form>
</div>
</div>

<?php
include("includes/footerlinks.php");
?>
</body>
</html>