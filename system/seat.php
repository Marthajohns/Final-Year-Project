<?php
session_start();
include ("db.php");
$ticket = $_GET["ticket"];
if($ticket == ""){header('Location: book.php');}
$sql = "SELECT * FROM bookings where invoice='$ticket'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while( $row = mysqli_fetch_assoc($result) ){
  $date = $row['travel_date'];
  $_SESSION['seater'] = $row;
}
} else {
  header('Location: book.php');
}
$sql = "SELECT * FROM seats where seatno='$ticket'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    header('Location: book.php');
}
if(!empty($_POST["seat"])){
  $str=implode(",",$_POST['data']);
 $seat = $_POST["seat"];
$sql = "UPDATE bookings SET seat='$str' WHERE invoice='$ticket'";

if ($conn->query($sql) === TRUE) {
  $checkbox = $_POST['data'];
  for($i=0;$i<count($checkbox);$i++){
  $check_id = $checkbox[$i];
  mysqli_query($conn,"insert into seats (date, seatno, ticket) values ('$date', '".$check_id."', '$ticket')") or die(mysqli_error($conn));
  }

  header('Location: complete.php?ticket='.$ticket);
} else {
echo '<script>alert("An error occured.");</script>';
}
}
function seat_status($seatno, $type, $date){
  include ("db.php");
  $sql = "SELECT seatno FROM seats where date='$date' AND seatno='$seatno' limit 1";
  $result = mysqli_query($conn, $sql);
  switch ($type) {
    case "div":
           while( $row = mysqli_fetch_assoc($result) ){
             $booked = $row['seatno'];
             if($booked == $seatno){echo 'class="bg-primary" onclick="booked()"';}
          }
        break;
    case "input":
           while( $row = mysqli_fetch_assoc($result) ){
           $booked = $row['seatno'];
           if($booked == $seatno){echo 'disabled';}
            }

        break;
}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book seat</title>
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mob.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/materialize.css" />
    <script src="js/jquery.min.js"></script>


    <style>
    #ck-button {
    background-color:#EFEFEF;
    border-radius:4px;
    border:1px solid #D0D0D0;
    float:left;
}

#ck-button:hover {
    background:red;
}

#ck-button label {
    text-align: center;

}

#ck-button label span {
    text-align:center;
    width: 40px; height: 30px;
    display:block;
}


#ck-button input:checked + span {
    background-color:#911;
    color:#fff;
    width: 40px; height: 30px;
    border-radius:4px;
}
   .disabled {cursor: no-drop;}
    </style>
</head>
<body>

    <?php include ('includes/navbar.php');?>
      <br/> <br/> <br/>
<div class="container">
<form action="" method="post">
   <div class="row">
   	<div class="col-md-5">
   		<label style="color: maroon; font-size: 18px; font-weight: bolder;">Kindly Select Your Seat</label>

		<table>
         <h4>Coach A</h4>
         <?php $coach = "A"; ?>
				<tr>
            <td><div id="ck-button" <?php seat_status($coach."0", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."0", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."0";  ?>"><span><?php echo $coach."0";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."1", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."1", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."1";  ?>"><span><?php echo $coach."1";  ?></span></label></div></td>
            <td>&nbsp; &nbsp;</td>
             <td><div id="ck-button" <?php seat_status($coach."2", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."2", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."2";  ?>"><span><?php echo $coach."2";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."3", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."3", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."3";  ?>"><span><?php echo $coach."3";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."4", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."4", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."4";  ?>"><span><?php echo $coach."4";  ?></span></label></div></td>
        </tr>
        <tr>
            <td><div id="ck-button" <?php seat_status($coach."5", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."5", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."5";  ?>"><span><?php echo $coach."5";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."6", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."6", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."6";  ?>"><span><?php echo $coach."6";  ?></span></label></div></td>
            <td>&nbsp; &nbsp;</td>
             <td><div id="ck-button" <?php seat_status($coach."7", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."7", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."7";  ?>"><span><?php echo $coach."7";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."8", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."8", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."8";  ?>"><span><?php echo $coach."8";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."9", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."9", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."9";  ?>"><span><?php echo $coach."9";  ?></span></label></div></td>
        </tr>
        <tr>
            <td><div id="ck-button" <?php seat_status($coach."10", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."10", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."10";  ?>"><span><?php echo $coach."10";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."11", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."11", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."11";  ?>"><span><?php echo $coach."11";  ?></span></label></div></td>
            <td>&nbsp; &nbsp;</td>
             <td><div id="ck-button" <?php seat_status($coach."12", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."12", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."12";  ?>"><span><?php echo $coach."12";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."13", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."13", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."13";  ?>"><span><?php echo $coach."13";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."14", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."14", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."14";  ?>"><span><?php echo $coach."14";  ?></span></label></div></td>
        </tr>
        <tr>
            <td><div id="ck-button" <?php seat_status($coach."15", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."15", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."15";  ?>"><span><?php echo $coach."15";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."16", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."16", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."16";  ?>"><span><?php echo $coach."16";  ?></span></label></div></td>
            <td>&nbsp; &nbsp;</td>
             <td><div id="ck-button" <?php seat_status($coach."17", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."17", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."17";  ?>"><span><?php echo $coach."17";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."18", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."18", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."18";  ?>"><span><?php echo $coach."18";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."19", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."19", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."19";  ?>"><span><?php echo $coach."19";  ?></span></label></div></td>
        </tr>
        <tr>
            <td><div id="ck-button" <?php seat_status($coach."20", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."20", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."20";  ?>"><span><?php echo $coach."20";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."21", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."21", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."21";  ?>"><span><?php echo $coach."21";  ?></span></label></div></td>
            <td>&nbsp; &nbsp;</td>
             <td><div id="ck-button" <?php seat_status($coach."22", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."22", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."22";  ?>"><span><?php echo $coach."22";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."23", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."23", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."23";  ?>"><span><?php echo $coach."23";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."24", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."24", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."24";  ?>"><span><?php echo $coach."24";  ?></span></label></div></td>
        </tr>
          <td colspan='6'><h4>Coach B</h4>
            <?php $coach = "B"; ?>
        </tr>

        <tr>
            <td><div id="ck-button" <?php seat_status($coach."0", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."0", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."0";  ?>"><span><?php echo $coach."0";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."1", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."1", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."1";  ?>"><span><?php echo $coach."1";  ?></span></label></div></td>
            <td>&nbsp; &nbsp;</td>
             <td><div id="ck-button" <?php seat_status($coach."2", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."2", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."2";  ?>"><span><?php echo $coach."2";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."3", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."3", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."3";  ?>"><span><?php echo $coach."3";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."4", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."4", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."4";  ?>"><span><?php echo $coach."4";  ?></span></label></div></td>
        </tr>
        <tr>
            <td><div id="ck-button" <?php seat_status($coach."5", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."5", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."5";  ?>"><span><?php echo $coach."5";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."6", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."6", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."6";  ?>"><span><?php echo $coach."6";  ?></span></label></div></td>
            <td>&nbsp; &nbsp;</td>
             <td><div id="ck-button" <?php seat_status($coach."7", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."7", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."7";  ?>"><span><?php echo $coach."7";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."8", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."8", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."8";  ?>"><span><?php echo $coach."8";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."9", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."9", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."9";  ?>"><span><?php echo $coach."9";  ?></span></label></div></td>
        </tr>
        <tr>
            <td><div id="ck-button" <?php seat_status($coach."10", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."10", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."10";  ?>"><span><?php echo $coach."10";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."11", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."11", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."11";  ?>"><span><?php echo $coach."11";  ?></span></label></div></td>
            <td>&nbsp; &nbsp;</td>
             <td><div id="ck-button" <?php seat_status($coach."12", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."12", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."12";  ?>"><span><?php echo $coach."12";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."13", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."13", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."13";  ?>"><span><?php echo $coach."13";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."14", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."14", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."14";  ?>"><span><?php echo $coach."14";  ?></span></label></div></td>
        </tr>
        <tr>
            <td><div id="ck-button" <?php seat_status($coach."15", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."15", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."15";  ?>"><span><?php echo $coach."15";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."16", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."16", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."16";  ?>"><span><?php echo $coach."16";  ?></span></label></div></td>
            <td>&nbsp; &nbsp;</td>
             <td><div id="ck-button" <?php seat_status($coach."17", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."17", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."17";  ?>"><span><?php echo $coach."17";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."18", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."18", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."18";  ?>"><span><?php echo $coach."18";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."19", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."19", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."19";  ?>"><span><?php echo $coach."19";  ?></span></label></div></td>
        </tr>
        <tr>
            <td><div id="ck-button" <?php seat_status($coach."20", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."20", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."20";  ?>"><span><?php echo $coach."20";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."21", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."21", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."21";  ?>"><span><?php echo $coach."21";  ?></span></label></div></td>
            <td>&nbsp; &nbsp;</td>
             <td><div id="ck-button" <?php seat_status($coach."22", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."22", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."22";  ?>"><span><?php echo $coach."22";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."23", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."23", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."23";  ?>"><span><?php echo $coach."23";  ?></span></label></div></td>
            <td><div id="ck-button" <?php seat_status($coach."24", "div", $date); ?> style="width: 40px; height: 30px; "><label><input  <?php seat_status($coach."24", "input", $date); ?> class="single-checkbox" name="data[]" type="checkbox" value="<?php echo $coach."24";  ?>"><span><?php echo $coach."24";  ?></span></label></div></td>
        </tr>
    </table>
   	</div>
    <div class="col-md-4" style="padding-left: 4%;">
   		<label style="color: green; font-weight: bolder; font-size: 15px;">Key</label>
   		 <ul>
   		 	<li style="font-weight: bolder; font-size: 18px;"><button class="btn btn-primary" style="width: 40px; height: 30px; "></button>&nbsp;&nbsp;&nbsp;Booked
   		 	</li>
   		 	<br/>
   		 	<li style="font-weight: bolder; font-size: 18px;"><button class="btn btn-default" style="width: 40px; height: 30px; "></button>&nbsp;&nbsp;&nbsp;Empty
   		 	</li>
   		 	<br/>
   		 	<li style="font-weight: bolder; font-size: 18px;"><button class="btn btn-danger" style="width: 40px; height: 30px; "></button>&nbsp;&nbsp;&nbsp;Your Seat
   		 	</li><br>
        <div class="form-group">
        <input type="submit" name="seat" class="btn btn-success" value="Finish">
        </div>
   		 </ul>
   	</div>
   	<div class="col-md-3">

   	</div>
   </div>
   </form>
 </div>
   <script>
   var limit = <?php echo $_SESSION['seater']['seats_no']; ?>;
   $('input[type=checkbox]').on('change', function (e) {
       if ($('input[type=checkbox]:checked').length > <?php echo $_SESSION['seater']['seats_no']; ?>) {
           $(this).prop('checked', false);
           alert("You qualify for only <?php echo $_SESSION['seater']['seats_no']; ?> seat(s)");
       }
   });
   </script>
   <script>
   function booked() {
  alert("This seat has been taken! Please pick another one.");
}
   </script>
</body>
</html>
