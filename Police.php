<?php
require 'processor/units.php';
$query="select * from alerts";
$result= mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "BeeLine - Police";
include("includes/headlinks.php");
$bartit = "Beeline Police";
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>.custab{
    border: 1px solid #ccc;
    padding: 5px;
    margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
.custab:hover{
    box-shadow: 3px 3px 0px transparent;
    transition: 0.5s;
    }</style>
</head>


<!------ Include the above in your HEAD tag ---------->
<body class="bg-red">
<div class="container">
    <div class="row mt-5">
    <table class="table table-striped custab">
    
    <thead>
    <h2 class="display-6 f text-centre">Accident and Fraud Reports</h2>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Vehicle_no</th>
            <th>Location</th>
            <th>Time</th>
            <th>Report</th>
        </tr>
    </thead>
            <tr>
                <?php
                while($row=mysqli_fetch_assoc($result))
                {?>
                <td> <?php echo $row['id']; ?> </td>
                <td> <?php echo $row['email']; ?> </td>
                <td> <?php echo $row['vehicle_no']; ?> </td>
                <td> <?php echo $row['location']; ?> </td>
                <td> <?php echo $row['time']; ?> </td>
                <td> <?php echo $row['report']; ?> </td>
            </tr>
                    <?php


                }
                ?>
    </table>
    </div>
</div>