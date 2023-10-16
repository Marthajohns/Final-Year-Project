<?php
list($tab, $element, $end) = explode("_", $el);
if($tab == "ba"){
    $tables = "basics";
  }
$elems = ike_getSiteData($tables);
$element = $tab."_".$element;
foreach($elems as $e){
  $position = $e[$item];
  if($position == $item_m){
     echo $e[$data];
  }
    if($e["element"] === $element){
     echo $e[$end];
  }

}

/*
$crumbs = explode("/",$_SERVER["REQUEST_URI"]);
foreach($crumbs as $crumb){
    echo ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . ' ');
}


*/
 ?>
