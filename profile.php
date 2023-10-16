<?php
require 'processor/units.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "Beeline - Profile";
include("includes/headlinks.php");
$bartit = "My Profile";
?>
</head>
<body class="bg-light">

<div class="zinnia-profile">
<?php
include("includes/togglemenu.php");
?>

<div class="px-3 pt-3 pb-5">
<form action="profile.php">
<div class="d-flex justify-content-center rounded-2 mb-4">
<div class="form-profile w-100">
<div class="text-center mb-3 position-relative">
<div class="position-absolute edit-bt">
<label for="upload-photo" class="mb-0"><span class="icofont-pencil-alt-5 text-white"></span></label>
<input type="file" name="photo" id="upload-photo" />
</div>
<img src="img/user1.jpg" class="rounded-pill">
</div>
<div class="form-group">
<label class="text-muted f-10 mb-1">Your Name</label>
<input type="text" class="form-control" placeholder="Enter User Name" value="<?php echo $user["name"]; ?>">
</div>
<div class="form-group">
<label class="text-muted f-10 mb-1">Mobile Number</label>
<input type="number" class="form-control" placeholder="Enter Mobile Number" value="1234567890">
</div>
<div class="form-group">
<label class="text-muted f-10 mb-1">Your Email</label>
<input type="email" class="form-control" placeholder="Enter Your Email" value="<?php echo $user["email"]; ?>">
</div>
<div class="form-group">
<label class="text-muted f-10 mb-1">City</label>
<input type="text" class="form-control" placeholder="Enter City" value="Nairobi">
</div>
<div class="form-group">
<label class="text-muted f-10 mb-1">State</label>
<input type="text" class="form-control" placeholder="Enter State" value="Nairobi">
</div>
<div class="form-group">
<label class="text-muted f-10 mb-1">Address</label>
<textarea class="form-control" placeholder="Enter Address">House #675, Sector #12, Road #20 Dhaka-123001</textarea>
</div>
<div class="form-group">
<label class="text-muted f-10 mb-1">Life Insurance</label>
<div class="mt-1">
 <div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="yes" name="lifeinsurance" class="custom-control-input" checked>
<label class="custom-control-label small" for="yes">Yes</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="no" name="lifeinsurance" class="custom-control-input">
<label class="custom-control-label small" for="no">No</label>
</div>
</div>
</div>
<div class="mb-5">
<a href="home.php" class="btn btn-danger btn-block zinniabus-btn rounded-1">UPDATE PROFILE</a>
</div>
</div>
</div>
</form>
</div>
</div>

<?php
  include("includes/nav.php");
  include("includes/footerlinks.php");
?>
</body>
</html>