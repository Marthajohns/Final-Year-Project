<?php
require 'processor/units.php';
$query="select * from reviews";
$result= mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "BeeLine - Reviews";
include("includes/headlinks.php");
$bartit = "Beeline Reviews";
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
    <h2 class="display-6 f text-centre">Reviews and Ratings</h2>
        <tr>
            <th>ID</th>
            <th>Punctual</th>
            <th>Service</th>
            <th>Clean</th>
            <th>Comfort</th>
            <th>Text</th>
            <th>Time</th>
        </tr>
    </thead>
            <tr>
                <?php
                while($row=mysqli_fetch_assoc($result))
                {?>
                <td> <?php echo $row['id']; ?> </td>
                <td> <?php echo $row['punctual']; ?> </td>
                <td> <?php echo $row['service']; ?> </td>
                <td> <?php echo $row['clean']; ?> </td>
                <td> <?php echo $row['comfort']; ?> </td>
                <td> <?php echo $row['text']; ?> </td>
                <td> <?php echo $row['time']; ?> </td>
            </tr>
                    <?php


                }
                ?>

    </table>
    </div>
</div>