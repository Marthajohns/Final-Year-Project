<?php
if($liveserver == 0){
  $assetroot = $rootlink.$folder.$dashboard;
  $imageroot = $rootlink.$folder.$images;
}elseif ($liveserver == 1) {
  $assetroot = $rootlink.$dashboard;
  $imageroot = $rootlink.$images;
}
$assetroot = $r.$dashboard;
if($file == "home"){
  $file_title = "Home";
}elseif($file == "admin"){
  $admin = 1;
  $file_title = "Admin";
}else{
  $admin = 0;
  $file_title = "";
}
 ?>
