<?php
require 'processor/units.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "Beeline customer Feedback";
include("includes/headlinks.php");
$bartit = "Customer Feedback";
?>
</head>
<body class="bg-light">

<div class="zinnia-feedback padding-bt">
<?php
include("includes/togglemenu.php");
?>

<form method="post" action="processor/controllers/engine.php" class="p-3 feedback">
<div class="form-group mb-3 w-100 d-flex align-items-center">
<label for="exampleFormControlFile1" class="mb-0">Punctuality</label><br>
<div class="rate ml-auto">
<input type="radio" id="Punctuality5" name="data[punctual]" value="5" />
<label for="Punctuality5" title="text"></label>
<input type="radio" id="Punctuality4" name="data[punctual]" value="4" />
<label for="Punctuality4" title="text"></label>
<input type="radio" id="Punctuality3" name="data[punctual]" value="3" />
<label for="Punctuality3" title="text"></label>
<input type="radio" id="Punctuality2" name="data[punctual]" value="2" />
<label for="Punctuality2" title="text"></label>
<input type="radio" id="Punctuality1" name="data[punctual]" value="1" />
<label for="Punctuality1" title="text"></label>
</div>
</div>
<div class="form-group mb-3 w-100 d-flex align-items-center">
<label for="exampleFormControlFile2" class="mb-0">Services & Staff</label><br>
<div class="rate ml-auto">
<input type="radio" id="Services5" name="data[service]" value="5" />
<label for="Services5" title="text"></label>
<input type="radio" id="Services4" name="data[service]" value="4" />
<label for="Services4" title="text"></label>
<input type="radio" id="Services3" name="data[service]" value="3" />
<label for="Services3" title="text"></label>
<input type="radio" id="Services2" name="data[service]" value="2" />
<label for="Services2" title="text"></label>
<input type="radio" id="Services1" name="data[service]" value="1" />
<label for="Services1" title="text"></label>
</div>
</div>
<div class="form-group mb-3 w-100 d-flex align-items-center">
<label for="exampleFormControlFile3" class="mb-0">Bus Cleanliness</label><br>
<div class="rate ml-auto">
<input type="radio" id="Cleanliness5" name="data[clean]" value="5" />
<label for="Cleanliness5" title="text"></label>
<input type="radio" id="Cleanliness4" name="data[clean]" value="4" />
<label for="Cleanliness4" title="text"></label>
<input type="radio" id="Cleanliness3" name="data[clean]" value="3" />
<label for="Cleanliness3" title="text"></label>
<input type="radio" id="Cleanliness2" name="data[clean]" value="2" />
<label for="Cleanliness2" title="text"></label>
<input type="radio" id="Cleanliness1" name="data[clean]" value="1" />
<label for="Cleanliness1" title="text"></label>
</div>
</div>
<div class="form-group mb-3 w-100 d-flex align-items-center">
<label for="exampleFormControlFile4" class="mb-0">Comfort</label><br>
<div class="rate ml-auto">
<input type="radio" id="Comfort5" name="data[comfort]" value="5" />
<label for="Comfort5" title="text"></label>
<input type="radio" id="Comfort4" name="data[comfort]" value="4" />
<label for="Comfort4" title="text"></label>
<input type="radio" id="Comfort3" name="data[comfort]" value="3" />
<label for="Comfort3" title="text"></label>
<input type="radio" id="Comfort2" name="data[comfort]" value="2" />
<label for="Comfort2" title="text"></label>
<input type="radio" id="Comfort1" name="data[comfort]" value="1" />
<label for="Comfort1" title="text"></label>
</div>
</div>
<div class="form-group mb-5 w-100">
<textarea class="form-control form-control-sm p-2 bg-textarea border rounded-1" name="data[text]" id="validationTextarea" placeholder="Customer Comment"></textarea>
</div>
<div class="submit-btn fixed-bottom m-3">
<input type="hidden" name="table" value="reviews">
<input type="submit"name="sub_data" class="btn btn-danger btn-block zinniabus-btn" value="SUBMIT FEEDBACK">
<input type="hidden" name="back" value="../../sent.php">
</div>
</form>
</div>

<?php
  include("includes/nav.php");
  include("includes/footerlinks.php");
?>
</body>
</html>