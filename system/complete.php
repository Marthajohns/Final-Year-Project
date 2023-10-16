<?php
session_start();
$ticket = $_GET["ticket"];
if($ticket == ""){header('Location: book.php');}
include ("db.php");
$sql = "SELECT * FROM bookings where invoice='$ticket'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
header('Location: book.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Completed</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mob.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/materialize.css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/jspdf.js"></script>
		<script>
    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#content')[0];

        // we support special element handlers. Register them with jQuery-style
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF
                //          this allow the insertion of new lines after html
                pdf.save('Madaraka-Express-Ticket-<?php echo $ticket ?>.pdf');
            }, margins
        );
    }
</script>
</head>
<body>
    <?php include ('includes/navbar.php');?>
    <br/><br/><br/>
  <div class="container">
    <?php
    $sql = "SELECT * FROM bookings where invoice='$ticket'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    while( $row = mysqli_fetch_assoc($result) ){?>

      <div class="card">
        <a href="javascript:demoFromHTML()" class="btn btn-primary">Download Ticket</a>
        <div id="content">
        <div class="card-header">
          <b><u>ZinniaWys Ticket</u></b>
        </div>
        <div class="card-body">
          <h6 class="card-title"><b>No.:</b> <?php echo $row['invoice']; ?></h6>
          <p class="card-text"><b>Name:</b> <?php echo $row['name']; ?></p>
          <p class="card-text"><b>From:</b> <?php echo $row['place_from']; ?></p>
          <p class="card-text"><b>To:</b> <?php echo $row['place_to']; ?></p>
          <p class="card-text"><b>Seat number:</b> <?php echo $row['seat']; ?></p>
					<p class="card-text"><b>Date of booking:</b> <?php echo $row['dated']; ?></p>
          <p class="card-text"><b>Date of travel:</b> <?php echo $row['travel_date']; ?></p>
          <p class="card-text"><b>Amount Paid:</b> <?php echo $row['total_price']; ?></p>
          <p class="card-text"><b>M-Pesa code:</b> <?php echo strtoupper($row['mpesa']); ?></p>
          <p class="card-text"><small>Thank you for choosing to travel with us. Kindly avail this ticket at the train's entry.
          <br><b>Contacts</b><br>
           Phone: +254 123456789<br>
         Email: info@zinniaways.co.ke<br>
        Website: https://www.zinniaways.co.ke</small></p>


        </div>
      </div>
  <?php  }
    } ?>
  </div>
</div>
</body>
</html>
