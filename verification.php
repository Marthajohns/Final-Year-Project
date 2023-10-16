<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "BeeLine - Verification";
include("includes/headlinks.php");
?>
</head>
<body>

<div class="zinnia-verification">
<div class="zinnia-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
<h5 class="font-weight-normal mb-0 text-white">
<a class="text-danger mr-3" href="signup.php"><i class="icofont-rounded-left"></i></a>
Enter verification code
</h5>
<div class="ml-auto d-flex align-items-center">
<a class="toggle zinnia-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
</div>
</div>
<div class="zinnia-form px-3 py-5 text-center mb-5">
<form action="home.php" method="POST">
<div class="row my-5 px-3 pb-2">
<div class="col px-1">
<input type="number" value="1" class="form-control opt border-0 form-control-lg text-center pb-0 px-0">
</div>
<div class="col px-1">
<input type="number" value="3" class="form-control opt border-0 form-control-lg text-center pb-0 px-0">
</div>
<div class="col px-1">
<input type="number" value="1" class="form-control opt border-0 form-control-lg text-center pb-0 px-0">
</div>
<div class="col px-1">
<input type="number" value="3" class="form-control opt border-0 form-control-lg text-center pb-0 px-0">
</div>
</div>
<button type="submit" name="submit_button" class="btn btn-danger btn-block zinniabus-btn mb-4">VERIFY</button>
<p class="text-muted">Didn't receive it?<a href="#" class="ml-2 text-danger">Resend</a></p>
</form>
</div>
</div>

<?php
    include("includes/nav.php");
include("includes/footerlinks.php");
?>
</body>

</html>