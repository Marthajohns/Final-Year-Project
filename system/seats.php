<?php
if(!empty($_POST["seat"])){
 $seat = $_POST["seat"];
 $invoice = $_POST["invoice"];
$sql = "UPDATE bookings SET seat='$seat' WHERE invoice='$invoice'";

if ($conn->query($sql) === TRUE) {
  $output = '{ "code": "yes"}';
header('Content-type:application/json;charset=utf-8');
echo $output;
} else {
  $output = '{ "code": "no" }';
header('Content-type:application/json;charset=utf-8');
echo $output;
}
}
 ?>
