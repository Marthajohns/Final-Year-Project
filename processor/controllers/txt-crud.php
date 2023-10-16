<?php
foreach($_POST as $key=>$value)
{
  file_put_contents("../txts/texdb/$key.txt", $value);
}
if(file_exists("../txts/texdb/0.txt")){
  $output = '{ "code": "yes"}';
header('Content-type:application/json;charset=utf-8');
echo $output;
unlink("../txts/texdb/0.txt");
}else {
  $output = '{ "code": "no"}';
header('Content-type:application/json;charset=utf-8');
echo $output;
}

?>
