<?php
if(!empty($_SESSION['success']) && $_SESSION['success']=='success'){
  $message = "<div class='alert alert-success text-center' id='success-alert' style='margin: auto; width: 50%;'>
  <button type='button' class='close' data-dismiss='alert'>x</button>
  <strong>Success!</strong><br>
  Action completed.
  </div>";
	unset($_SESSION['success']);

} elseif (!empty($_SESSION['success']) && $_SESSION['success']=='fail') {
  $message = "<div class='alert alert-danger text-center' id='success-alert' style='margin: auto; width: 50%;'>
  <button type='button' class='close' data-dismiss='alert'>x</button>
  <strong>Failed!</strong><br>
  An error occured.
  </div>";
    unset($_SESSION['success']);
}

 ?>
