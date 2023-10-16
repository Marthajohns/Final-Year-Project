<div class="vh-100 zinnia-coming-soon p-4 d-flex justify-content-center align-items-center">
<div class="zinnia-text text-center">
    <div id="map"></div>
<div class="zinnia-img px-3 pb-1">
<img src="img/no-buus.svg" class="img-fluid mb-1">
</div>
<h2 class="mb-3 font-weight-bold text-danger">Not Available</h2>
<p class="lead small mb-0">No bus found for selected dates or cities.</p>
<p class="mb-5">If you think this is a problem with us, please <a class="text-danger" href="support">tell us</a>.</p>
<a href="home.php" class="btn btn-danger px-5 zinniabus-btn rounded-1 mt-4">Go Back</a>
</div>
</div>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
       // Initialize the Google Maps API v3
var map = new google.maps.Map(document.getElementById('map'), {
  zoom: 15,
  mapTypeId: google.maps.MapTypeId.ROADMAP
});

var marker = null;

function autoUpdate() {
  navigator.geolocation.getCurrentPosition(function(position) {  
    var newPoint = new google.maps.LatLng(position.coords.latitude, 
                                          position.coords.longitude);

    if (marker) {
      // Marker already created - Move it
      marker.setPosition(newPoint);
    }
    else {
      // Marker does not exist - Create it
      marker = new google.maps.Marker({
        position: newPoint,
        map: map
      });
    }

    // Center the map on the new position
    map.setCenter(newPoint);
  }); 

  // Call the autoUpdate() function every 5 seconds
  setTimeout(autoUpdate, 5000);
}

autoUpdate(); 
    </script>