<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "BeeLine - Sign Up";
include("includes/headlinks.php");
?>
<style>
#password-strength-status {
    padding: 5px 10px;
    border-radius: 4px;
    margin-top: 5px;
}

.medium-password {
    background-color: #fd0;
}

.weak-password {
    background-color: #FBE1E1;
}

.strong-password {
    background-color: #D5F9D5;
}
</style>
</head>
<body>

<div class="zinnia-signup">
<div class="zinnia-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
<h5 class="font-weight-normal mb-0 text-white">
<a class="text-danger mr-3" href="get-started.php"><i class="icofont-rounded-left"></i></a>
Create an account
</h5>
<div class="ml-auto d-flex align-items-center">
<a class="toggle zinnia-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
</div>
</div>
<div class="p-3">
<form class="ajax-form">
<div class="form-group">
<label class="text-muted f-10 mb-1">Your Name</label>
<input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
</div>
<div class="form-group">
<label class="text-muted f-10 mb-1">Your Email</label>
<input type="email" name="email" class="form-control" placeholder="Enter Your Email" id="echeck" onblur="check_user();" required>
    <div id="usercheck"></p>
</div>
<div class="form-group">
<label class="text-muted f-10 mb-1">Password</label>
<input type="password" id="NewPassword" name="password" class="form-control" placeholder="Enter Your Password" onkeyup="checkPasswordStrength();" required>
<div id="password-strength-status"></div>
</div>
<div class="form-group">
<label class="text-muted f-10 mb-1">Confirm Password</label>
<input type="password" id="ConfirmPassword" name="password2" class="form-control" placeholder="Confirm Password" required>
<span id="PasswordMatch"></span>
</div>
    <input type="hidden" name="register" value="Register" />
    <input type="submit" class="btn btn-danger btn-block zinniabus-btn mb-3 rounded-1 mt-4" 
    id="regg" name="up" value="CREATE AN ACCOUNT" disabled />

<p class="text-muted text-center small">By signing up you agree to our Privacy Policy and Terms.</p>
</form>
<div class="sign-or d-flex align-items-center justify-content-center mb-4">
<hr class="mr-4">
<p class="text-muted text-center py-2 m-0">OR</p>
<hr class="ml-4">
</div>
<a href="signin.php" class="btn btn-block btn-light zinniabus-btn">SIGN IN</a>
</div>
</div>

<?php
include("includes/nav.php");
include("includes/footerlinks.php");
?>
</body>
</html>
