<?php
require 'processor/units.php';
$query="select * from users";
$result= mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$title = "BeeLine - Bookings";
include("includes/headlinks.php");
$bartit = "Beeline Bookings";
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
    <h2 class="display-6 f text-centre">Bookings</h2>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>Name</th>
            <th>Type</th>
            <th>Photo</th>
        </tr>
    </thead>
            <tr>
                <?php
                while($row=mysqli_fetch_assoc($result))
                {?>
                <td> <?php echo $row['id']; ?> </td>
                <td> <?php echo $row['email']; ?> </td>
                <td> <?php echo $row['password']; ?> </td>
                <td> <?php echo $row['name']; ?> </td>
                <td> <?php echo $row['type']; ?> </td>
                <td> <?php echo $row['photo']; ?> </td>
            </tr>
                    <?php


                }
                ?>

    </table>
    </div>
</div>