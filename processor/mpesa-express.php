<?php
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];
$amount = $_SESSION['checkout']['totalcost'];
$unid = $_SESSION['checkout']['ticketno'];
$email = $user["email"];
if(!empty($_GET['phone'])){
  $phone = $_GET["phone"];
}else{
  $phone = "";
}

?>
<form id="" action="https://payments.ipayafrica.com/v3/ke" method="post" name="mpesa">
<?php
            $fields = array("live"=> "1",
               "oid"=> $unid,
               "inv"=> $unid,
               "ttl"=> 1,#$amount
               "tel"=> $phone,
               "eml"=> $email,
               "vid"=> "iluos",
               "curr"=> "KES",
               "p1"=> "",
               "p2"=> "",
               "p3"=> "",
               "p4"=> "",
               "cbk"=> $link,
               "cst"=> "1",
               "crl"=> "0"
               );

              $datastring =  $fields['live'].$fields['oid'].$fields['inv'].$fields['ttl'].$fields['tel'].$fields['eml'].$fields['vid'].$fields['curr'].$fields['p1'].$fields['p2'].$fields['p3'].$fields['p4'].$fields['cbk'].$fields['cst'].$fields['crl'];
              $hashkey ="dsdtffy75746trghhv";
              $generated_hash = hash_hmac('sha1',$datastring , $hashkey);

         ?>
         <?php
foreach ($fields as $key => $value) {
     #echo $key;
    echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
}
?><input name="hsh" type="hidden" value="<?php echo $generated_hash ?>">
<div class="form-group mb-2">
<div class="d-flex align-items-start">
<label for="exampleInputEmail1" class="mb-1 small text-muted">M-Pesa Number</label>
<img src="img/mpesa.png" class="img-fluid ml-auto rounded" style="width: 70px; padding: 5px;">
</div>
<input type="number" class="form-control form-control-sm" placeholder="M-Pesa Number" id="pesanum" aria-describedby="emailHelp">
 </div>
</form>
<a href="" class="btn btn-danger btn-block" id="payref" >Pay</a>
