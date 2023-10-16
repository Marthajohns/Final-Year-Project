<?php
session_start();
$conn=new mysqli("localhost" , "root" , "" , "Beeline");
//pdo
$dbhost = 'localhost';
$dbname = 'Beeline';
$dbuser = 'root';
$dbpass = '';

try {
    $db = new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e) {
    echo "Connection error: ".$e->getMessage();
}

if( !empty($_SESSION['user_id']) ){

	$records = $db->prepare('SELECT * FROM users WHERE id = :id');
    $seid = $_SESSION['user_id'];
	$records->bindParam(':id', $seid );
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}

}else{
	header("Location: signin.php");
}

if(!empty($_GET["logout"]) && $_GET["logout"] == "true"){
  session_unset();
  session_destroy();
  header('Location: signin.php');
}

function seat_status($seatno, $type){
  global $conn;
	global $route;
	global $coach;
  global $date;
  $sql = "SELECT seatno FROM seats where busid='$coach' AND date='$date' AND seatno='$seatno' and route='$route' limit 1";
  $result = mysqli_query($conn, $sql);
  switch ($type) {
		case "bookedalert":
           while( $row = mysqli_fetch_assoc($result) ){
             $booked = $row['seatno'];
             if($booked == $seatno){echo 'onclick="booked()"';}
          }
        break;
    case "bookedclass":
           while( $row = mysqli_fetch_assoc($result) ){
             $booked = $row['seatno'];
             if($booked == $seatno){echo 'btn-danger';}
          }
          if (mysqli_num_rows($result)==0) { echo 'btn-success'; }
        break;
    case "input":
           while( $row = mysqli_fetch_assoc($result) ){
           $booked = $row['seatno'];
           if($booked == $seatno){echo 'checked disabled';}
            }

        break;
}

}

if(!empty($_POST["seat"])){
  $seatsselect=implode(",",$_POST['data']);
  $_SESSION['seatsselect'] = $seatsselect;
  $_SESSION['singles'] = $_POST["data"];
  $totalcost=$_POST['tcost'];
  $selseats=$_POST['selseats'];
}
$bartit = "";
 ?>
