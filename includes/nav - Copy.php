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
<li>
<a href="landing.php"><i class="icofont-stylish-right mr-2"></i> Landing</a>
</li>
<li>
<a href="get-started.php"><i class="icofont-ui-play mr-2"></i> Get Started</a>
</li>
<li>
<a href="#"><i class="icofont-key mr-2"></i> Authentication</a>
<ul>
<li><a href="signin.php">Sign In</a></li>
<li><a href="signup.php">Sign Up</a></li>
<li><a href="change-password.php">Change Password</a></li>
<li><a href="verification.php">Verification</a></li>
</ul>
</li>
<li><a href="home.php"><i class="icofont-ui-home mr-2"></i> Homepage</a></li>
<li><a href="gift-card.php"><i class="icofont-sale-discount mr-2"></i> Offers</a></li>
<li><a href="listing.php"><i class="icofont-list mr-2"></i> Listing</a></li>
<li><a href="bus-details.php"><i class="icofont-file-text mr-2"></i> Bus Detail</a></li>
<li><a href="select-seat.php"><i class="icofont-check-circled mr-2"></i> Select Seat</a></li>
<li><a href="payment.php"><i class="icofont-id-card mr-2"></i> Checkout</a></li>
<li><a href="payment-card.php"><i class="icofont-ui-v-card mr-2"></i> Payment</a></li>
<li>
<a href="#"><i class="icofont-user-alt-3 mr-2"></i> Profile Pages</a>
<ul>
<li><a href="profile.php"> Profile</a></li>
<li><a href="your-ticket.php"> Your Ticket</a></li>
<li><a href="my-ticket.php"> History</a></li>
<li><a href="customer-feedback.php"> Customer Feedback</a></li>
</ul>
</li>
<li>
<a href="#"><i class="icofont-page mr-2"></i> Extra Pages</a>
<ul>
<li><a href="support.php">Support</a></li>
<li><a href="notification.php">Notification</a></li>
<li><a href="not-available.php">Not Available</a></li>
<li><a href="404.php"> Not Found</a></li>
</ul>
</li>
<li>
<a href="#"><i class="icofont-link mr-2"></i> Navigation Link Example</a>
<ul>
<li>
<a href="#">Link Example 1</a>
<ul>
<li>
<a href="#">Link Example 1.1</a>
<ul>
<li><a href="#">Link</a></li>
<li><a href="#">Link</a></li>
<li><a href="#">Link</a></li>
<li><a href="#">Link</a></li>
<li><a href="#">Link</a></li>
</ul>
</li>
<li>
<a href="#">Link Example 1.2</a>
<ul>
<li><a href="#">Link</a></li>
<li><a href="#">Link</a></li>
<li><a href="#">Link</a></li>
<li><a href="#">Link</a></li>
</ul>
</li>
</ul>
</li>
<li><a href="#">Link Example 2</a></li>
<li><a href="#">Link Example 3</a></li>
<li><a href="#">Link Example 4</a></li>
<li data-nav-custom-content>
<div class="custom-message">
You can add any custom content to your navigation items. This text is just an example.
</div>
</li>
</ul>
</li>
</ul>
<ul class="bottom-nav">
<li class="email">
<a class="text-danger nav-item text-center" href="home.php" tabindex="0" role="menuitem">
<p class="h5 m-0"><i class="icofont-ui-home text-danger"></i></p>
Home
</a>
</li>
<li class="github">
<a href="gift-card.php" class="nav-item text-center" tabindex="0" role="menuitem">
<p class="h5 m-0"><i class="icofont-sale-discount"></i></p>
Offer
</a>
</li>
<li class="ko-fi">
<a href="support.php" class="nav-item text-center" tabindex="0" role="menuitem">
<p class="h5 m-0"><i class="icofont-support-faq"></i></p>
Help
</a>
</li>
</ul>
</nav>