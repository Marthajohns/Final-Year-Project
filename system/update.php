<?php
$conn=new mysqli("localhost" , "root" , "" , "sgr");
if(isset($_POST['status']))
{
	$details=explode(" ", $_POST['status']);
	if($details[1]==="empty")
		$details[1]="reserved";
	else
		$details[1]="empty";
	$sql="update seats set status='".$details[1]."', identification='".$_POST['idno']."' where id=".$details[0];
	$conn->query($sql);
	echo "Success";
}
if(isset($_POST['book']))
{
	$sql="INSERT INTO bookings(idno, seats_no, place_from, place_to, unit_cost, total_price) VALUES ('".$_POST['idno']."','".$_POST['seats_no']."','".$_POST['from']."','".$_POST['to']."','".$_POST['unit_price']."','".$_POST['total_cost']."')";
	$conn->query($sql);
	echo "Seats booked!";
}
?>