                                                                                                                                                                                                                                                                                                                                           <!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "BeeLine - Sign In";
include("includes/headlinks.php");
?>
</head>
<body>

<div class="zinnia-signup">
<div class="zinnia-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
<h5 class="font-weight-normal mb-0 text-white">
<a class="text-danger mr-3" href="get-started.php"><i class="icofont-rounded-left"></i></a>
Sign in to your account
</h5>
<div class="ml-auto d-flex align-items-center">
<a class="toggle zinnia-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
</div>
</div>
<div class="px-3 pt-3 pb-5">
<form class="ajax-form">
<div class="form-group">
<label class="text-muted f-10 mb-1">Your Email</label>
<input type="email" name="email" class="form-control" placeholder="Enter Your Email" required>
</div>
<div class="form-group">
<label class="text-muted f-10 mb-1">Password</label>
<input type="password" name="password" class="form-control" placeholder="Enter Your Password" required>
</div>
<div class="text-right mb-3">
<a href="change-password.php" class="text-muted small">Forgot your password?</a>
</div>
    <input type="hidden" name="login" value="Login"/>

<input type="submit" class="btn btn-danger btn-block zinniabus-btn mb-4 rounded-1" name="in" value="SIGN IN" />
</form>
<div class="sign-or d-flex align-items-center justify-content-center mb-4">
<hr class="mr-4">
<p class="text-muted text-center py-2 m-0">OR</p>
<hr class="ml-4">
</div>
<a href="signup.php" class="btn btn-block btn-light zinniabus-btn">CREATE AN ACCOUNT</a>
<div class="sign-or d-flex align-items-center justify-content-center mb-4">
<hr class="mr-4">
<p class="text-muted text-center py-2 m-0">OR</p>
<hr class="ml-4">
</div>
<a href="Verify.php" class="btn btn-block btn-light zinniabus-btn">Sign As Other</a>
</div>

<?php
include("includes/nav.php");
include("includes/footerlinks.php");
?>
</body>
</html>