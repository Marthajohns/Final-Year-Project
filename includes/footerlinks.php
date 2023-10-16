<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/64d1fedbcc26a871b02df6da/1h7a4n2ue';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js" ></script>
<script src="js/engine.js" ></script>
<script src="vendor/sidebar/hc-offcanvas-nav.js"></script>
<script src="vendor/slick/slick.min.js"></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"741e6758f9edd741","version":"2022.8.0","r":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}' crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="vendor/loader.min.js"></script>
<script src="js/custom.js" ></script>
<script>
    $(document).ready(function() {
     var currgeocoder;

     //Set geo location  of lat and long

     navigator.geolocation.getCurrentPosition(function(position, html5Error) {

         geo_loc = processGeolocationResult(position);
         currLatLong = geo_loc.split(",");
         initializeCurrent(currLatLong[0], currLatLong[1]);

    });

    //Get geo location result

   function processGeolocationResult(position) {
         html5Lat = position.coords.latitude; //Get latitude
         html5Lon = position.coords.longitude; //Get longitude
         html5TimeStamp = position.timestamp; //Get timestamp
         html5Accuracy = position.coords.accuracy; //Get accuracy in meters
         return (html5Lat).toFixed(8) + ", " + (html5Lon).toFixed(8);
   }

    //Check value is present or not & call google api function

    function initializeCurrent(latcurr, longcurr) {
         currgeocoder = new google.maps.Geocoder();
         console.log(latcurr + "-- ######## --" + longcurr);

         if (latcurr != '' && longcurr != '') {
             var myLatlng = new google.maps.LatLng(latcurr, longcurr);
             return getCurrentAddress(myLatlng);
         }
   }

    //Get current address

     function getCurrentAddress(location) {
          currgeocoder.geocode({
              'location': location

        }, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                console.log(results[0]);
                $("#address").html(results[0].formatted_address);
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
     }
});
    </script>
