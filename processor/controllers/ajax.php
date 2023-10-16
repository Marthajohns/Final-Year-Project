<?php
session_start();
require 'db.php';
$uploadpath = "../images/uploads/";
if(!empty($_POST['login'])):

  $records = $connection->prepare('SELECT * FROM business_admins WHERE email = :email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

  if(password_verify($_POST['password'], $results['password']) ){

    $_SESSION['business_id'] = $results['id'];
    $output = '{ "code": "yes"}';
header('Content-type:application/json;charset=utf-8');
echo $output;

  } else {
    $output = '{ "code": "no" }';
header('Content-type:application/json;charset=utf-8');
echo $output;
  }

endif;

if(!empty($_POST['register'])):

  // Enter the new user in the database
  $sql = "INSERT INTO business_admins (email, password, name, bizcode, ac) VALUES (:email, :password, :name, :bizcode, :ac)";
  $stmt = $connection->prepare($sql);

  $stmt->bindParam(':email', $_POST['email']);
  $pass = $_POST['password'];
  $pass = password_hash($pass, PASSWORD_BCRYPT);
  $stmt->bindParam(':password', $pass);
  $stmt->bindParam(':name', $_POST['name']);
  $stmt->bindParam(':bizcode', $_POST['bizcode']);
  $stmt->bindParam(':ac', $_POST['ac']);

  if( $stmt->execute() ):

 $records = $connection->prepare('SELECT * FROM business_admins WHERE email = :email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);
  $_SESSION['business_id'] = $results;

    $output = '{ "code": "yes","a": "'.$_POST['bizcode'].'","e": "'.$_POST['email'].'","t": "'.$_POST['ac'].'"}';
header('Content-type:application/json;charset=utf-8');
echo $output;
  else:
     $output = '{ "code": "no" }';
header('Content-type:application/json;charset=utf-8');
echo $output;
  endif;

endif;
/*==================================================================================
                                  Sub-data                                                   ===============================================================*/
if(!empty($_POST["sub_data"])){
  $table = $_POST["table"];
  if (empty($_POST['back'])) {
    $bc_url = $_SERVER['HTTP_REFERER'];
  }elseif (!empty($_POST['back'])) {
    $bc_url = $_POST['back'];
  }
  $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FORCE_ARRAY);

  if(!empty($_FILES['image'])){
    $tmp=explode('.',$_FILES['image']['name']);
    $extension = end($tmp);
      $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
    if(!empty($extension)){$image = $file_name;} else {$image = $img;}

    move_uploaded_file($file_tmp,$uploadpath.$file_name);
    if (is_array($data)){
           $data = array_merge($data, array("image"=>$file_name));
  }else{
      $data = [];
      $data = array_merge($data, array("image"=>$file_name));
  }
  }

  if(!empty($_FILES['image2'])){
    $tmp=explode('.',$_FILES['image2']['name']);
    $extension = end($tmp);
      $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
      $file_tmp =$_FILES['image2']['tmp_name'];
      $file_type=$_FILES['image2']['type'];
    if(!empty($extension)){$image2="img/".$file_name;} else {$image2 = $img2;}

    move_uploaded_file($file_tmp,$uploadpath.$file_name);
    if (is_array($data)){
           $data = array_merge($data, array("image2"=>$file_name));
  }else{
      $data = [];
      $data = array_merge($data, array("image2"=>$file_name));
  }
  }

  if(!empty($_FILES['image3'])){
    $tmp=explode('.',$_FILES['image3']['name']);
    $extension = end($tmp);
      $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
      $file_tmp =$_FILES['image3']['tmp_name'];
      $file_type=$_FILES['image3']['type'];
    if(!empty($extension)){$image3="img/".$file_name;} else {$image3 = $img3;}

    move_uploaded_file($file_tmp,$uploadpath.$file_name);
    if (is_array($data)){
           $data = array_merge($data, array("image3"=>$file_name));
  }else{
      $data = [];
      $data = array_merge($data, array("image3"=>$file_name));
  }
  }

  if(!empty($_FILES['image4'])){
    $tmp=explode('.',$_FILES['image4']['name']);
    $extension = end($tmp);
      $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
      $file_tmp =$_FILES['image4']['tmp_name'];
      $file_type=$_FILES['image4']['type'];
    if(!empty($extension)){$image4="img/".$file_name;} else {$image4 = $img4;}

    move_uploaded_file($file_tmp,$uploadpath.$file_name);
    if (is_array($data)){
           $data = array_merge($data, array("image4"=>$file_name));
  }else{
      $data = [];
      $data = array_merge($data, array("image4"=>$file_name));
  }
  }

  if(!empty($_FILES['image5'])){
    $tmp=explode('.',$_FILES['image5']['name']);
    $extension = end($tmp);
      $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
      $file_tmp =$_FILES['image5']['tmp_name'];
      $file_type=$_FILES['image5']['type'];
    if(!empty($extension)){$image5="img/".$file_name;} else {$image5 = $img5;}

    move_uploaded_file($file_tmp,$uploadpath.$file_name);
    if (is_array($data)){
           $data = array_merge($data, array("image5"=>$file_name));
  }else{
      $data = [];
      $data = array_merge($data, array("image5"=>$file_name));
  }
  }

    if(!empty($_POST['options']))
{

    $two=implode("_", $_REQUEST['options']);
    $data = array_merge($data, array("options"=>$two));
}

  $columns = implode(", ",array_keys($data));
  $values  = implode('","', array_values($data));
  $values = '"'.$values.'"';

     $sql = "INSERT INTO $table ($columns) VALUES ($values)";
  if (mysqli_multi_query($conn, $sql)) {
      $output = '{ "code": "yes"}';
header('Content-type:application/json;charset=utf-8');
echo $output;

    } else {
      $output = '{ "code": "no" }';
header('Content-type:application/json;charset=utf-8');
echo $output;

}
}
/*==================================================================================
                                  Edit                                                 ===============================================================*/


if(!empty($_POST['edit'])){
  $id = $_POST['id'];
  $id = $_POST['id'];
  if (empty($_POST['back'])) {
    $bc_url = $_SERVER['HTTP_REFERER'];
  }elseif (!empty($_POST['back'])) {
    $bc_url = $_POST['back'];
  }
  if (empty($_POST['id'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }

  $table = $_POST["table"];
  $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FORCE_ARRAY);

  if(!empty($_FILES['image'])){
    $tmp=explode('.',$_FILES['image']['name']);
    $extension = end($tmp);
      $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
	  if(!empty($extension)){$image = $file_name;} else {$image = $img;}

	  move_uploaded_file($file_tmp,$uploadpath.$file_name);
    if (is_array($data)){
             $data = array_merge($data, array("image"=>$file_name));
    }else{
        $data = [];
        $data = array_merge($data, array("image"=>$file_name));
    }

  }

  if(!empty($_FILES['image2'])){
    $tmp=explode('.',$_FILES['image2']['name']);
    $extension = end($tmp);
      $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
      $file_tmp =$_FILES['image2']['tmp_name'];
      $file_type=$_FILES['image2']['type'];
    if(!empty($extension)){$image2="img/".$file_name;} else {$image2 = $img2;}

    move_uploaded_file($file_tmp,$uploadpath.$file_name);
    if (is_array($data)){
             $data = array_merge($data, array("image2"=>$file_name));
    }else{
        $data = [];
        $data = array_merge($data, array("image2"=>$file_name));
    }
  }

  if(!empty($_FILES['image3'])){
    $tmp=explode('.',$_FILES['image3']['name']);
    $extension = end($tmp);
      $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
      $file_tmp =$_FILES['image3']['tmp_name'];
      $file_type=$_FILES['image3']['type'];
    if(!empty($extension)){$image3="img/".$file_name;} else {$image3 = $img3;}

    move_uploaded_file($file_tmp,$uploadpath.$file_name);
    if (is_array($data)){
             $data = array_merge($data, array("image3"=>$file_name));
    }else{
        $data = [];
        $data = array_merge($data, array("image3"=>$file_name));
    }
  }

  if(!empty($_FILES['image4'])){
    $tmp=explode('.',$_FILES['image4']['name']);
    $extension = end($tmp);
      $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
      $file_tmp =$_FILES['image4']['tmp_name'];
      $file_type=$_FILES['image4']['type'];
    if(!empty($extension)){$image4="img/".$file_name;} else {$image4 = $img4;}

    move_uploaded_file($file_tmp,$uploadpath.$file_name);
    if (is_array($data)){
             $data = array_merge($data, array("image4"=>$file_name));
    }else{
        $data = [];
        $data = array_merge($data, array("image4"=>$file_name));
    }
  }
  if(!empty($_FILES['image5'])){
    $tmp=explode('.',$_FILES['image5']['name']);
    $extension = end($tmp);
      $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
      $file_tmp =$_FILES['image5']['tmp_name'];
      $file_type=$_FILES['image5']['type'];
    if(!empty($extension)){$image5="img/".$file_name;} else {$image5 = $img5;}

    move_uploaded_file($file_tmp,$uploadpath.$file_name);
    if (is_array($data)){
             $data = array_merge($data, array("image5"=>$file_name));
    }else{
        $data = [];
        $data = array_merge($data, array("image5"=>$file_name));
    }
  }
  if(!empty($_POST['options']))
{

  $two=implode("_", $_REQUEST['options']);
  $data = array_merge($data, array("options"=>$two));
}

  $s = "UPDATE $table SET ";

foreach($data as $k => $v){
 $s .= $k."='". $v."', ";
}

$s = rtrim($s, ", ");

$s .= " where id = $id";

  if($conn->query($s)){
    $output = '{ "code": "yes"}';
header('Content-type:application/json;charset=utf-8');
echo $output;
  }
  else{
    $output = '{ "code": "no" }';
header('Content-type:application/json;charset=utf-8');
echo $output;
  }
}
