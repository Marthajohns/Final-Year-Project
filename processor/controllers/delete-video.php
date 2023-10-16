<?php
include("db.php");
if(!empty($_GET['item'])){
  $id = $_GET['item'];
$result = mysqli_query($conn, "DELETE FROM videos WHERE content_id=$id");
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
 ?>
