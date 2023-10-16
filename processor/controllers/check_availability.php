<?php
session_start();
require_once("db.php");

if(!empty($_POST["serialize"])) {
  $table = $_POST["table"];
  $section = $_POST["section"];
  $secvalue = $_POST["data"][$section];
  $sql = "SELECT * FROM $table WHERE  $section='" . $secvalue . "'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      echo "<span style='color: red;'>Duplicate detected.</span>";
  }else{
      echo "";
  }
}

if(!empty($_POST["serialize2"])) {
  $table = $_POST["table"];
  $section = $_POST["section2"];
  $secvalue = $_POST["data"][$section];
  $sql = "SELECT * FROM $table WHERE  $section='" . $secvalue . "'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      echo "<span style='color: red;'>Duplicate detected.</span>";
  }else{
      echo "";
  }
}

if(!empty($_POST["serialize3"])) {
  $table = $_POST["table"];
  $section = $_POST["section3"];
  $secvalue = $_POST["data"][$section];
  $sql = "SELECT * FROM $table WHERE  $section='" . $secvalue . "'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      echo "<span style='color: red;'>Duplicate detected.</span>";
  }else{
      echo "";
  }
}

if(!empty($_POST["serialize4"])) {
  $table = $_POST["table"];
  $section = $_POST["section4"];
  $secvalue = $_POST["data"][$section];
  $sql = "SELECT * FROM $table WHERE  $section='" . $secvalue . "'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      echo "<span style='color: red;'>Duplicate detected.</span>";
  }else{
      echo "";
  }
}
?>
