<?php
include("db.php");
if(!empty($_GET['item'])){
  $id = $_GET['item'];
$result = mysqli_query($conn, "DELETE FROM news WHERE content_id=$id");
if(!empty($_GET["img"])){
  $img = $_GET["img"];
  $path = '../images/uploads/'.$img;
unlink($path);
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
 ?>
