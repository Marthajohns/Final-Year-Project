<?php
if($admin == 0){
  include("engine/controllers/db.php");
  include("engine/controllers/functions.php");
  $file = bryn_current_file_name();
  include("engine/controllers/variables.php");
  include("engine/controllers/dynamic-variables.php");
  include("engine/controllers/intelligence.php");
  include("engine/controllers/session_actions.php");
  $uploadpath ="uploads/";
  $engine = "engine/controllers/engine.php";
}elseif($admin == 1){
  include("../engine/controllers/db.php");
  include("../engine/controllers/functions.php");
  $file = bryn_current_file_name();
  include("../engine/controllers/variables.php");
  include("../engine/controllers/dynamic-variables.php");
  include("../engine/controllers/intelligence.php");
  include("../engine/controllers/session_actions.php");
  $uploadpath ="../uploads/";
  $engine = "../engine/controllers/engine.php";
}

if (!empty($_GET["action"])) {
  if($_GET["action"] == 'logout'){
    session_unset();
    session_destroy();
    header("Location: login.php");
  }
}


 ?>
