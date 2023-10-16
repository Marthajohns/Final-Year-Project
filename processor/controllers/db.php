<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "beeline";

$conn = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password , $mysql_database);
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}


try{
	$connection = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database;", $mysql_user, $mysql_password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}

?>
