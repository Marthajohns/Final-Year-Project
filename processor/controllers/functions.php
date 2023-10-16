<?php
//Get the name of the current files showing on the browser.
function bryn_current_file_name(){
    return basename($_SERVER['PHP_SELF']);
}
//Get data from database in an array
function bryn_getSiteData($sel, $table){
  global $conn,$connection;
       $sql = "SELECT $sel FROM $table";
          $data = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
          $results = array();

        while ($result = mysqli_fetch_array($data)) {
            $results[] = $result;
        }

        return $results;
}

function bryn_fetchspecific($item, $table) {
             global $conn,$connection;
                  $sql = "SELECT $item FROM $table";
                     $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
                        while( $rows = mysqli_fetch_assoc($resultset) ){
                           $content=htmlspecialchars_decode($rows[$item]);
                           #$content = nl2br($content);
                           if($rows[$item] == ''){
                            if($item == 'image' || $item == 'image2'|| $item == 'image3'|| $item == 'image4'){
                              $content = "no-image.jpg";
                            } else{$content = "Nothing to display.";}
                           }
                              return $content;
                           }
                  }

function bryn_insert_data($table, $data){


}


function bryn_edit_data($table, $data){


}


function bryn_delete_data($table, $data){


}

//Set any date format
function bryn_datime_format($date, $format){
  $date= date($format, strtotime($date));
  return $date;
}
//compare any date and time
function bryn_comparedate($yourdatime ){
if(strtotime($yourdatime) < strtotime(date('Y-m-d  H:i:s')))
{
   return "Past";
}
else if (strtotime($yourdatime) == strtotime(date('Y-m-d H:i:s'))){
  return "Today";
}
else if (strtotime($yourdatime) > strtotime(date('Y-m-d H:i:s'))){
  return "Upcoming";
}
}


function bryn_daysbetween ($start_date, $end_date){
       return $days_difference = ceil(abs($end_date - $start_date) / (60 * 60 * 24));
}


function bryn_time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


function bryn_numbertowords($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}
//indicate copyright year
function bryn_copyright_year($start_year){
  if($start_year==""){return "&copy;<script>document.write(new Date().getFullYear());</script>";}
  else {return "&copy;".$start_year." - <script>document.write(new Date().getFullYear());</script>";}

}


function bryn_executiontime(){
  $execution_time = microtime(); // Start counting

// Your code

$execution_time = microtime() - $execution_time;
printf('It took %.5f sec', $execution_time);
}


function bryn_https_or_http(){
  if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
    || $_SERVER['SERVER_PORT'] == 443) {

  // HTTPS

} else {

  // HTTP

}
}

function bryn_current_active($file){
  if($file == basename($_SERVER['PHP_SELF'])){
    return "active";
  }
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_getUrl() {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
  $url .= $_SERVER["REQUEST_URI"];
  return $url;
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_email(){
  // from the form
       $name = trim(strip_tags($_POST['name']));
       $email = trim(strip_tags($_POST['email']));
       $message = htmlentities($_POST['message']);

       // set here
       $subject = "Contact form submitted!";
       $to = 'your@email.com';

       $body = <<<HTML
$message
HTML;

       $headers = "From: $email\r\n";
       $headers .= "Content-type: text/html\r\n";

       // send the email
       mail($to, $subject, $body, $headers);

       // redirect afterwords, if needed
       header('Location: thanks.html');
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_rand_hex_color(){
  $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_limit_words($words, $limit, $append = ' &hellip;') {
       // Add 1 to the specified limit becuase arrays start at 0
       $limit = $limit+1;
       // Store each individual word as an array element
       // Up to the limit
       $words = explode(' ', $words, $limit);
       // Shorten the array by 1 because that final element will be the sum of all the words after the limit
       array_pop($words);
       // Implode the array for output, and append an ellipse
       $words = implode(' ', $words) . $append;
       // Return the result
       return $words;
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_cleanInput($input) {

  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );

    $output = preg_replace($search, '', $input);
    return $output;
  }

  /*<=========
  This fuctions
                                           ========================>*/

  function bryn_forceLeadingZero($int) {
    return (int)sprintf('%02d',$int);
  }

  /*<=========
  This fuctions
                                           ========================>*/

  function bryn_safestrip($string){
       $string = strip_tags($string);
       $string = mysql_real_escape_string($string);
       return $string;
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_random_slogans($file){
  $f_contents = file ($file);
       $line = $f_contents[array_rand ($f_contents)];
       print $line;
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_random_image_bg(){
  $bg = array('bg-01.jpg', 'bg-02.jpg', 'bg-03.jpg', 'bg-04.jpg', 'bg-05.jpg', 'bg-06.jpg', 'bg-07.jpg' ); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_redirect($url){
  header( 'Location: '.$url ) ;
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_MakeUnique($length=16) {
           $salt       = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
           $len        = strlen($salt);
           $makepass   = '';
           mt_srand(10000000*(double)microtime());
           for ($i = 0; $i < $length; $i++) {
               $makepass .= $salt[mt_rand(0,$len - 1)];
           }
       return $makepass;
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_count_results($col,$table,$where){
  include("engine/db.php");
  $sql = "SELECT $col FROM $table $where";
  $result = mysqli_query($conn, $sql);
  $total = mysqli_num_rows($result);
  echo $total;
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_specific_word_in_string($string, $word){
  if(strpos($string, $word) !== false){
    return true;
  }
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_is_mobile(){
  if (preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])) {
	// Is mobile...
}
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_num_position($int){
    $test_c = abs($int) % 10;
    $ext = ((abs($int) %100 < 21 && abs($int) %100 > 4) ? 'th'
            : (($test_c < 4) ? ($test_c < 3) ? ($test_c < 2) ? ($test_c < 1)
            ? 'th' : 'st' : 'nd' : 'rd' : 'th'));
    return $$int.$ext;
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_random_password($length, $characters='abcdefgh1234567890'){

    if ($characters == ''){ return ''; }
    $chars_length = strlen($characters)-1;

    mt_srand((double)microtime()*1000000);

    $pwd = '';
    while(strlen($pwd) < $length){
        $rand_char = mt_rand(0, $chars_length);
        $pwd .= $characters[$rand_char];
    }

    return $pwd;

}

/*<=========
This fuctions
                                         ========================>*/

function bryn_inc_count(){
	$ip = bryn_get_ip();
	global $counter_filename, $ip_filename;

	if(!in_array($ip, file($ip_filename, FILE_IGNORE_NEW_LINES))){
		$current_value = (file_exists($counter_filename)) ? file_get_contents($counter_filename) : 0;
		file_put_contents($ip_filename, $ip."\n", FILE_APPEND);
		file_put_contents($counter_filename, ++$current_value);
	}
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_get_ip(){
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
	$ip_address = $_SERVER['HTTP_CLIENT_IP'];
}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
	$ip_address = $_SERVER['REMOTE_ADDR'];
}
return $ip_address;
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_fetchtemplate1($table, $selector, $orderby, $limit) {
global $conn,$connection;
$sql = "SELECT * FROM $table WHERE $selector ORDER by $orderby $limit";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
while( $rows = mysqli_fetch_assoc($resultset) ){

echo '
<div class="panel-body">
<img src="'.htmlspecialchars_decode($rows['file_path']).'" alt="" style="width: 100%;">
<h4>'.htmlspecialchars_decode($rows['title']).'</h4>
<h5>'.substr(htmlspecialchars_decode($rows['content']),0,100).'</h5>
</div>
<div class="panel-footer">
<a href="index.php?page=edit&f=slides&id='.htmlspecialchars_decode($rows['id']).'" class="btn btn-success btn-sm">Edit</a>
</div>
';}
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_fetchtemplate2($table, $selector, $orderby, $limit) {
global $conn,$connection;
$sql = "SELECT * FROM $table WHERE $selector ORDER by $orderby $limit";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
while( $rows = mysqli_fetch_assoc($resultset) ){

echo '
<div class="panel-body">
<img src="'.htmlspecialchars_decode($rows['file_path']).'" alt="" style="width: 100%;">
<h4>'.htmlspecialchars_decode($rows['title']).'</h4>
<h5>'.substr(htmlspecialchars_decode($rows['content']),0,100).'</h5>
</div>
<div class="panel-footer">
<a href="index.php?page=edit&f=about&img=1&id='.htmlspecialchars_decode($rows['id']).'" class="btn btn-success btn-sm">Edit</a>
</div>
';}
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_fetchtemplate3($table, $selector, $orderby, $limit) {
global $conn,$connection;
$sql = "SELECT * FROM $table WHERE $selector ORDER by $orderby $limit";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
while( $rows = mysqli_fetch_assoc($resultset) ){

echo '
<div class="panel-body">
<h4>'.htmlspecialchars_decode($rows['title']).'</h4>
<h5>'.substr(htmlspecialchars_decode($rows['content']),0,100).'</h5>
</div>
<div class="panel-footer">
<a href="index.php?page=edit&f=about&id='.htmlspecialchars_decode($rows['id']).'" class="btn btn-success btn-sm">Edit</a>
</div>
';}
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_fetchtemplate4($table, $selector, $orderby, $limit) {
global $conn,$connection;
$sql = "SELECT * FROM $table WHERE $selector ORDER by $orderby $limit";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
while( $rows = mysqli_fetch_assoc($resultset) ){

echo '
<div class="panel-body">
<img src="'.htmlspecialchars_decode($rows['file_path']).'" alt="" style="width: 100%;">
<h4>'.htmlspecialchars_decode($rows['title']).'</h4>
<h5>'.substr(htmlspecialchars_decode($rows['content']),0,100).'</h5>
<h6> '.substr(htmlspecialchars_decode($rows['s_title']),0,100).'</h6>
</div>
<div class="panel-footer">
<a href="index.php?page=edit&f=team&id='.htmlspecialchars_decode($rows['id']).'" class="btn btn-success btn-sm">Edit</a>
</div>
';}
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_fetchtemplate5($table, $selector, $orderby, $limit) {
global $conn,$connection;
$sql = "SELECT * FROM $table WHERE $selector ORDER by $orderby $limit";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
while( $rows = mysqli_fetch_assoc($resultset) ){

echo '
<div class="panel-body">
<img src="'.htmlspecialchars_decode($rows['file_path']).'" alt="" style="width: 100%;">
<h4>'.htmlspecialchars_decode($rows['title']).'</h4>
<h5>'.substr(htmlspecialchars_decode($rows['content']),0,100).'</h5>
<h6> KES. '.substr(htmlspecialchars_decode($rows['value']),0,100).'</h6>
</div>
<div class="panel-footer">
<a href="index.php?page=edit&f=room&id='.htmlspecialchars_decode($rows['id']).'" class="btn btn-success btn-sm">Edit</a>
</div>
';}
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_fetchtemplate6($table, $selector, $orderby, $limit) {
global $conn,$connection;
$sql = "SELECT * FROM $table WHERE $selector ORDER by $orderby $limit";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
while( $rows = mysqli_fetch_assoc($resultset) ){

echo '
<div class="panel-body">
<img src="'.htmlspecialchars_decode($rows['file_path']).'" alt="" style="width: 100%;">
<h5>'.substr(htmlspecialchars_decode($rows['content']),0,100).'</h5>
</div>
<div class="panel-footer">
<a href="index.php?page=edit&f=about&img2=2&id='.htmlspecialchars_decode($rows['id']).'" class="btn btn-success btn-sm">Edit</a>
</div>
';}
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_fetchtemplate7($table, $selector, $orderby, $limit) {
global $conn,$connection;
$sql = "SELECT * FROM $table WHERE $selector ORDER by $orderby $limit";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
while( $rows = mysqli_fetch_assoc($resultset) ){

echo '
<div class="panel-body">
<h5>'.substr(htmlspecialchars_decode($rows['content']),0,100).'</h5>
</div>
<div class="panel-footer">
<a href="index.php?page=edit&f=about2&id='.htmlspecialchars_decode($rows['id']).'" class="btn btn-success btn-sm">Edit</a>
</div>
';}
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_userRating($userId, $restaurantId, $conn)
{
    $average = 0;
    $avgQuery = "SELECT rating FROM tbl_rating WHERE user_id = '" . $userId . "' and restaurant_id = '" . $restaurantId . "'";
    $total_row = 0;

    if ($result = mysqli_query($conn, $avgQuery)) {
        // Return the number of rows in result set
        $total_row = mysqli_num_rows($result);
    } // endIf

    if ($total_row > 0) {
        foreach ($result as $row) {
            $average = round($row["rating"]);
        } // endForeach
    } // endIf
    return $average;
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_Rating($restaurantId, $conn)
{
    $average = 0;
    $avgQuery = "SELECT rating FROM tbl_rating WHERE  restaurant_id = '" . $restaurantId . "'";
    $total_row = 0;

    if ($result = mysqli_query($conn, $avgQuery)) {
        // Return the number of rows in result set
        $total_row = mysqli_num_rows($result);
    } // endIf

    if ($total_row > 0) {
        foreach ($result as $row) {
            $average = round($row["rating"]);
        } // endForeach
    } // endIf
    return $average;
}

/*<=========
This fuctions
                                         ========================>*/

 // endFunction
function bryn_totalRating($restaurantId, $conn)
{
    $totalVotesQuery = "SELECT * FROM tbl_rating WHERE restaurant_id = '" . $restaurantId . "'";

    if ($result = mysqli_query($conn, $totalVotesQuery)) {
        // Return the number of rows in result set
        $rowCount = mysqli_num_rows($result);
        // Free result set
        mysqli_free_result($result);
    } // endIf

    return $rowCount;
}//endFunction

/*<=========
This fuctions
                                         ========================>*/

function bryn_requireToVar($file){
    ob_start();
    require($file);
    return ob_get_clean();
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_write_txt($admin, $txtfile, $txtcontent){

  if($admin == 0){
    file_put_contents("engine/txts/texdb/".$txtfile, $txtcontent);
  }
  if($admin == 1){
    file_put_contents("../engine/txts/texdb/".$txtfile, $txtcontent);
  }
  if($admin == 2){
    file_put_contents("../txts/texdb/".$txtfile, $txtcontent);
  }
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_read_txt($admin, $txtfile){
  if($admin == 0){
    if(file_exists("engine/txts/texdb/".$txtfile)){
      $contents = file_get_contents("engine/txts/texdb/".$txtfile);
      echo $contents;
    } else{
      echo "There is no content found.";
    }
  }
  if($admin == 1){
    if(file_exists("../engine/txts/texdb/".$txtfile)){
      $contents = file_get_contents("../engine/txts/texdb/".$txtfile);
      echo $contents;
    } else{
      echo "There is no content found.";
    }
  }
  if($admin == 2){
    if(file_exists("../txts/texdb/".$txtfile)){
      $contents = file_get_contents("../txts/texdb/".$txtfile);
      echo $contents;
    } else{
      echo "There is no content found.";
    }
  }


}

/*<=========
This fuctions
                                         ========================>*/

function bryn_read_txt_input($admin, $txtfile){
  if($admin == 0){
    if(file_exists("engine/txts/texdb/".$txtfile)){
      $contents = file_get_contents("engine/txts/texdb/".$txtfile);
      echo $contents;
    } else{
      echo "";
    }
  }
  if($admin == 1){
    if(file_exists("../engine/txts/texdb/".$txtfile)){
      $contents = file_get_contents("../engine/txts/texdb/".$txtfile);
      echo $contents;
    } else{
      echo "";
    }
  }
  if($admin == 2){
    if(file_exists("../txts/texdb/".$txtfile)){
      $contents = file_get_contents("../txts/texdb/".$txtfile);
      echo $contents;
    } else{
      echo "";
    }
  }
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_delete_txt($admin, $txtfile){
  if($admin == 0){
    if(file_exists("engine/txts/texdb/".$txtfile)){
   unlink($txtfile);
  }
  }
  if($admin == 1){
    if(file_exists("../engine/txts/texdb/".$txtfile)){
   unlink($txtfile);
  }
  }
  if($admin == 2){
    if(file_exists("../txts/texdb/".$txtfile)){
   unlink($txtfile);
  }
  }

}

/*<=========
This fuctions
                                         ========================>*/

function bryn_btedit_txt($form){
  echo '<i class="bt-edit fa fa-edit" data-form="'.$form.'" data-type="text" data-toggle="tooltip" data-placement="bottom" title="Edit Text"></i>';
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_btedit_txt_2($form){
  echo '<i class="bt-edit fa fa-edit" data-form="'.$form.'" data-type="text2" data-toggle="tooltip" data-placement="bottom" title="Edit Text"></i>';
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_btedit_txtarea($form){
  echo '<i class="bt-edit fa fa-edit" data-form="'.$form.'" data-type="textarea" data-toggle="tooltip" data-placement="bottom" title="Edit Text"></i>';
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_btedit_image($form){
  echo '<i class="bt-edit fa fa-edit" data-form="'.$form.'" data-type="image" data-toggle="tooltip" data-placement="bottom" title="Change Image"></i>';
}

/*<=========
This fuctions
                                         ========================>*/

function bryn_isValidEmail($email)
{
       //Perform a basic syntax-Check
       //If this check fails, there's no need to continue
       if(!filter_var($email, FILTER_VALIDATE_EMAIL))
       {
               return false;
       }

       //extract host
       list($user, $host) = explode("@", $email);
       //check, if host is accessible
       if (!checkdnsrr($host, "MX") && !checkdnsrr($host, "A"))
       {
               return false;
       }

       return true;
}

/*<=========
This fuctions
                                         ========================>*/
?>
