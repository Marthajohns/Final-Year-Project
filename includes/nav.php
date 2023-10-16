<nav id="main-nav">
<ul class="second-nav">
<li>
<a href="#" class="bg-danger sidebar-user d-flex align-items-center py-4 px-3 border-0 mb-0">
<img src="img/user1.jpg" class="img-fluid rounded-pill mr-3">
<div class="text-white">
<h6 class="mb-0"><?php echo $user["name"]; ?></h6>
<small><?php echo $user["email"]; ?></small><br>
</div>
</a>
</li>
<?php
if(!empty($_SESSION['user_id'])){
  echo '<li>
  <a href="?logout=true"><i class="icofont-logout mr-2"></i> Logout</a>
  </li>';
}else{
  echo '<li>
  <a href="signin.php"><i class="icofont-logout mr-2"></i> Logout</a>
  </li>';
}
 ?>
<li><a href="home.php"><i class="icofont-ui-home mr-2"></i> Homepage</a></li>
<li>
<a href="#"><i class="icofont-user-alt-3 mr-2"></i> Profile Pages</a>
<ul>
<li><a href="profile.php"> Profile</a></li>
</ul>
</li>
</nav>
