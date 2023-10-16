<?php
session_start();
require 'db.php';
$uploadpath = "../../images/uploads/";
$message="";
$file_name = "";

//Loging
if(!empty($_POST["login"])){
if(!empty($_POST['email']) && !empty($_POST['password'])):

	$records = $connection->prepare('SELECT id,email,password FROM user_admins WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if(!empty($results['email']) && password_verify($_POST['password'], $results['password']) ){
    $_SESSION['login'] = "Success";
		$_SESSION['user_admin'] = $results['id'];
		header( 'Location: '.$_SERVER['HTTP_REFERER'] );


	} else {
    $_SESSION['login'] = "Fail";
		header( 'Location: '.$_SERVER['HTTP_REFERER'] );
	}

endif;
}

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
      if(!empty($extension)){$image2 = $file_name;} else {$image2 = $img2;}

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
      if(!empty($extension)){$image3 = $file_name;} else {$image3 = $img3;}

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
      if(!empty($extension)){$image4 = $file_name;} else {$image4 = $img4;}

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
      if(!empty($extension)){$image5 = $file_name;} else {$image5 = $img5;}

      move_uploaded_file($file_tmp,$uploadpath.$file_name);
      if (is_array($data)){
             $data = array_merge($data, array("image5"=>$file_name));
    }else{
        $data = [];
        $data = array_merge($data, array("image5"=>$file_name));
    }
    }

/*
    if(!empty($_FILES['attachPhoto1']['name'])) {
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $error_uploads = 0;
        $total_uploads = array();
        $upload_path = 'upload/';
        foreach($_FILES['attachPhoto1']['name'] as $key => $value) {
            $temp = explode(".", $_FILES['attachPhoto1']['name'][$key]);
            $extension = end($temp);
            if ($_FILES["files"]["type"][$key] != "image/gif"
                && $_FILES["files"]["type"][$key] != "image/jpeg"
                && $_FILES["files"]["type"][$key] != "image/jpg"
                && $_FILES["files"]["type"][$key] != "image/pjpeg"
                && $_FILES["files"]["type"][$key] != "image/x-png"
                && $_FILES["files"]["type"][$key] != "image/png"
                && !in_array($extension, $allowedExts)) {
                $error_uploads++;
                continue;
            }
            $file_name = time().rand(1,5).rand(6,10).'_'.str_replace(' ', '_', $_FILES["attachPhoto1"]['name'][$key]);
            if(move_uploaded_file($_FILES["attachPhoto1"]['tmp_name'][$key], $upload_path.$file_name)) {
                $total_uploads[] = $file_name;
            } else {
                $error_uploads++;
            }
        }
        if(sizeof($total_uploads)) {
        //Do what ever you like after file uploads, you can run query here to save it in database or set redirection after success upload
        }
        }
    }
    */

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
      $_SESSION['success'] = "success";
        header('Location: ' . $bc_url);

    } else {
      $_SESSION['success'] = "fail";
      header('Location: ' . $bc_url);
      #echo mysqli_error($conn);

}
}
/*==================================================================================
                                  Edit                                                 ===============================================================*/


if(!empty($_POST['edit'])){
  $id = $_POST['id'];
  if (empty($_POST['back'])) {
    $bc_url = $_SERVER['HTTP_REFERER'];
  }elseif (!empty($_POST['back'])) {
    $bc_url = $_POST['back'];
  }
  if (empty($_POST['spec'])) {
    $spec = "id";
  }elseif (!empty($_POST['spec'])) {
    $spec = $_POST['spec'];
  }
  if (empty($_POST['id'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }

  $table = $_POST["table"];
  $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FORCE_ARRAY);

  if(!empty($_FILES['image'])){
      $img = $_POST['img'];
      $tmp=explode('.',$_FILES['image']['name']);
      $extension = end($tmp);
      $file_tmp =$_FILES['image']['tmp_name'];
  	  if(!empty($extension)){
        $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
        $image = $file_name;
        move_uploaded_file($file_tmp,$uploadpath.$file_name);
        if (is_array($data)){
                 $data = array_merge($data, array("image"=>$file_name));
        }else{
            $data = [];
            $data = array_merge($data, array("image"=>$file_name));
        }
      }
    }

    if(!empty($_FILES['image2'])){
      $img2 = $_POST['img2'];
      $tmp=explode('.',$_FILES['image2']['name']);
      $extension = end($tmp);
      $file_tmp =$_FILES['image2']['tmp_name'];
  	  if(!empty($extension)){
        $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
        $image = $file_name;
        move_uploaded_file($file_tmp,$uploadpath.$file_name);
        if (is_array($data)){
                 $data = array_merge($data, array("image2"=>$file_name));
        }else{
            $data = [];
            $data = array_merge($data, array("image2"=>$file_name));
        }
      }
    }

    if(!empty($_FILES['image3'])){
      $img3 = $_POST['img3'];
      $tmp=explode('.',$_FILES['image3']['name']);
      $extension = end($tmp);
      $file_tmp =$_FILES['image3']['tmp_name'];
  	  if(!empty($extension)){
        $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
        $image = $file_name;
        move_uploaded_file($file_tmp,$uploadpath.$file_name);
        if (is_array($data)){
                 $data = array_merge($data, array("image3"=>$file_name));
        }else{
            $data = [];
            $data = array_merge($data, array("image3"=>$file_name));
        }
      }
    }

    if(!empty($_FILES['image4'])){
      $img4 = $_POST['img4'];
      $tmp=explode('.',$_FILES['image4']['name']);
      $extension = end($tmp);
      $file_tmp =$_FILES['image4']['tmp_name'];
      if(!empty($extension)){
        $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
        $image = $file_name;
        move_uploaded_file($file_tmp,$uploadpath.$file_name);
        if (is_array($data)){
                 $data = array_merge($data, array("image4"=>$file_name));
        }else{
            $data = [];
            $data = array_merge($data, array("image4"=>$file_name));
        }
      }
    }
    if(!empty($_FILES['image5'])){
      $img4 = $_POST['img5'];
      $tmp=explode('.',$_FILES['image5']['name']);
      $extension = end($tmp);
      $file_tmp =$_FILES['image5']['tmp_name'];
      if(!empty($extension)){
        $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
        $image = $file_name;
        move_uploaded_file($file_tmp,$uploadpath.$file_name);
        if (is_array($data)){
                 $data = array_merge($data, array("image5"=>$file_name));
        }else{
            $data = [];
            $data = array_merge($data, array("image5"=>$file_name));
        }
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

$s .= " where $spec = $id";

  if($conn->query($s)){
    $_SESSION['success'] = "success";
      header('Location: ' . $bc_url);
  }
  else{
    $_SESSION['success'] = "fail";
    header('Location: ' . $bc_url);
    #echo mysqli_error($conn);
  }
}

/*==================================================================================
                                  SubmitImage                                               ===============================================================*/


if(isset($_POST['submitImage']))
{ $dir = $_POST['dir'];
	for($i=0;$i<count($_FILES["uploadFile"]["name"]);$i++)
	{
		$uploadfile=$_FILES["uploadFile"]["tmp_name"][$i];
		$folder=$dir."/";


		move_uploaded_file($_FILES["uploadFile"]["tmp_name"][$i], "$folder".$_FILES["uploadFile"]["name"][$i]);
	}
  $_SESSION['success'] = "success";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


/*==================================================================================
                                  Add                                                  ===============================================================*/


if(!empty($_POST['add'])):
if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name'])):

	// Enter the new user in the database
	$sql = "INSERT INTO user_admins (email, password, name, type) VALUES (:email, :password, :name, :type)";
	$stmt = $connection->prepare($sql);

	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));
	$stmt->bindParam(':name', $_POST['name']);
  $stmt->bindParam(':type', $_POST['type']);

	if( $stmt->execute() ):
		$_SESSION['success'] = "success";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
	else:
		$_SESSION['success'] = "fail";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
	endif;
header('Location: ' . $_SERVER['HTTP_REFERER']);

endif;
endif;
/*==================================================================================
                                  Prof                                                  ===============================================================*/


if(!empty($_POST['prof'])):

	$records = $connection->prepare('SELECT password FROM user_admins WHERE id = :id');
	$records->bindParam(':id', $_POST['id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	if(password_verify($_POST['password'], $results['password']) ){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $id = $_POST['id'];
        $img = $_POST['img'];

        if(!empty($_FILES['image'])){
            $extension=strtolower(end(explode('.',$_FILES['image']['name'])));
            $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
      	  if(!empty($extension)){$image = $file_name;} else {$image = $img;}

      	  move_uploaded_file($file_tmp,$uploadpath.$file_name);
          $upload = mysqli_real_query($conn, "UPDATE user_admins SET photo='$image' where id = $id");
        } else{$image = $img; $upload = mysqli_real_query($conn, "UPDATE user_admins SET photo='$image' where id = $id");}

		$sql = "UPDATE user_admins SET name='$name', email='$email' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "success";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    $_SESSION['success'] = "fail";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


	} else {
		$_SESSION['success'] = "fail";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

endif;
/*==================================================================================
                                  Prof2                                                 ===============================================================*/


if(!empty($_POST['prof2'])):
        $name = $_POST['name'];
        $type = $_POST['type'];
        $email = $_POST['email'];
        $id = $_POST['id'];
        $img = $_POST['img'];

        if(!empty($_FILES['image'])){
            $extension=strtolower(end(explode('.',$_FILES['image']['name'])));
            $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
      	  if(!empty($extension)){$image = $file_name;} else {$image = $img;}

      	  move_uploaded_file($file_tmp,$uploadpath.$file_name);
          $upload = mysqli_real_query($conn, "UPDATE user_admins SET photo='$image' where id = $id");
        } else{$image = $img; $upload = mysqli_real_query($conn, "UPDATE user_admins SET photo='$image' where id = $id");}

		$sql = "UPDATE user_admins SET name='$name', email='$email', type='$type' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "success";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    $_SESSION['success'] = "fail";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

endif;
/*==================================================================================
                                  Pass                                                 ===============================================================*/


if(!empty($_POST['pass'])):

	$records = $connection->prepare('SELECT password FROM user_admins WHERE id = :id');
	$records->bindParam(':id', $_POST['id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	if(password_verify($_POST['password'], $results['password']) ){
        $newpass = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
        $id = $_POST['id'];

		$sql = "UPDATE user_admins SET password='$newpass' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "success";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    $_SESSION['success'] = "fail";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


	} else {
		$_SESSION['success'] = "fail";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

endif;
/*==================================================================================
                                  Pass2                                                  ===============================================================*/


if(!empty($_POST['pass2'])):
        $newpass = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
        $id = $_POST['id'];

		$sql = "UPDATE user_admins SET password='$newpass' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "success";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    $_SESSION['success'] = "fail";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

endif;

/*=====================================================================================
                                       Action: Cart
                                                                                         =====================================================*/
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
	  if(!empty($_POST["sub"])) {
			if(!empty($_POST["pck"])){
				if (!empty($_POST["quantity"])){$quantity=$_POST["quantity"];

           $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE id='" . $_GET["p"] . "'");
			$itemArray = array($productByCode[0]["id"]=>array('name'=>$productByCode[0]["name"], 'id'=>$productByCode[0]["id"], 'quantity'=>$quantity, 'price'=>$productByCode[0]["price"], 'info'=>$productByCode[0]["info"]));
                                          }else{
                  $in=$_POST["in"];
			       $out=$_POST["out"];
			        $date1=date_create($_POST["in"]);
                  $date2=date_create($_POST["out"]);
									 #$quantity=date_diff($date1,$date2);
									 if ( strtotime($in) === strtotime($out) ){$quantity = 1;}
                  else{$quantity=date_diff($date1,$date2);}

         $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE id='" . $_GET["p"] . "'");
			$itemArray = array($productByCode[0]["id"]=>array('name'=>$productByCode[0]["name"], 'id'=>$productByCode[0]["id"], 'quantity'=>$quantity->format('%d'), 'price'=>$productByCode[0]["price"], 'info'=>$productByCode[0]["info"]));
           }


			if(!empty($_SESSION["cart_package"])) {
				if(in_array($productByCode[0]["id"],array_keys($_SESSION["cart_package"]))) {
					foreach($_SESSION["cart_package"] as $k => $v) {
							if($productByCode[0]["id"] == $k) {
								if(empty($_SESSION["cart_package"][$k]["quantity"])) {
									$_SESSION["cart_package"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_package"][$k]["quantity"] += $quantity;
							}
					}
				} else {
					$_SESSION["cart_package"] = array_merge($_SESSION["cart_package"],$itemArray);
				}
			} else {
				$_SESSION["cart_package"] = $itemArray;
			}

} else {

				            if (!empty($_POST["quantity"])){$quantity=$_POST["quantity"];

           $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE id='" . $_GET["p"] . "'");
			$itemArray = array($productByCode[0]["id"]=>array('name'=>$productByCode[0]["name"], 'id'=>$productByCode[0]["id"], 'quantity'=>$quantity, 'price'=>$productByCode[0]["price"], 'info'=>$productByCode[0]["info"], 'image'=>$productByCode[0]["image"]));
                                          }else{
                  $in=$_POST["in"];
			       $out=$_POST["out"];
			        $date1=date_create($_POST["in"]);
                  $date2=date_create($_POST["out"]);
									 $const1=date_create("5/7/2019");
									 $const2=date_create("5/8/2019");
                  #$quantity=date_diff($date1,$date2);
									 if ( strtotime($in) == strtotime($out) ){$quantity=date_diff($const1,$const2);}else {
									 	$quantity=date_diff($date1,$date2);
									 }

         $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE id='" . $_GET["p"] . "'");
			$itemArray = array($productByCode[0]["id"]=>array('name'=>$productByCode[0]["name"], 'id'=>$productByCode[0]["id"], 'quantity'=>$quantity->format('%d'), 'price'=>$productByCode[0]["price"], 'info'=>$productByCode[0]["info"], 'image'=>$productByCode[0]["image"]));
           }


			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["id"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["id"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $quantity;
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
  header('Location: checkout.php');
			}
		}
	break;
	case "remove":
          if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["id"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			} header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	break;
	case "empty":
	 if(!empty($_GET["e_pck"])){
       unset($_SESSION["cart_package"]);
       unset($_SESSION["package"]);
				header('Location: ' . $_SERVER['HTTP_REFERER']);

	 } else {
    unset($_SESSION["cart_item"]);
		 header('Location: ' . $_SERVER['HTTP_REFERER']);

	 }


	break;
}
}

/* =================================================================================================================
Business Administrator algorithms
By Business admins and System admins.
=======================================================================================================================*/

if(!empty($_POST['add_biz_acc'])):
if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name'])):

  if($_POST['status'] == 0){
    $dt1 = new DateTime("-1 day");
    $date = $dt1->format("Y-m-d");
  } elseif($_POST['status'] == 1){
    $dur = "+".$_POST['duration'];
    $dt1 = new DateTime();
    $today = $dt1->format("Y-m-d");
    $dt2 = new DateTime("$dur month");
    $date = $dt2->format("Y-m-d");
  }

  try {
    // Enter the new user in the database
   	$sql = "INSERT INTO business_admins (email, phone, password, name, status, bizcode, exp_date) VALUES (:email, :phone, :password, :name, :status, :bizcode, :exp_date)";
   	$stmt = $connection->prepare($sql);
   	$stmt->bindParam(':email', $_POST['email']);
     $stmt->bindParam(':phone', $_POST['phone']);
   	$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));
   	$stmt->bindParam(':name', $_POST['name']);
     $stmt->bindParam(':status', $_POST['status']);
     $stmt->bindParam(':bizcode', $_POST['bizcode']);
     $stmt->bindParam(':exp_date', $date);

   	if( $stmt->execute() ):
      if(!empty($_POST['front'])):
        $_SESSION['writer'] = $_POST['bizcode'];
      endif;
   		$_SESSION['success'] = "success";
       header('Location: ' . $_SERVER['HTTP_REFERER']);
   	else:
   		$_SESSION['success'] = "fail";
       header('Location: ' . $_SERVER['HTTP_REFERER']);
   	endif;
} catch (PDOException $e) {
   if ($e->errorInfo[1] == 1062) {
     $_SESSION['success'] = "fail";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   } else {
     $_SESSION['success'] = "fail";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
   }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);

endif;
endif;

if(!empty($_POST['prof_biz'])):

	$records = $connection->prepare('SELECT password FROM business_admins WHERE id = :id');
	$records->bindParam(':id', $_POST['id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	if(password_verify($_POST['password'], $results['password']) ){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $id = $_POST['id'];
        $img = $_POST['img'];

        if(!empty($_FILES['image'])){
            $extension=strtolower(end(explode('.',$_FILES['image']['name'])));
            $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
      	  if(!empty($extension)){$image=$file_name;} else {$image = $img;}

      	  move_uploaded_file($file_tmp,$uploadpath.$file_name);
          $upload = mysqli_real_query($conn, "UPDATE business_admins SET photo='$image' where id = $id");
        } else{$image = $img; $upload = mysqli_real_query($conn, "UPDATE business_admins SET photo='$image' where id = $id");}

		$sql = "UPDATE business_admins SET name='$name', phone='$phone', email='$email' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "success";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    $_SESSION['success'] = "fail";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


	} else {
		$_SESSION['success'] = "fail";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

endif;


if(!empty($_POST['prof_biz2'])):
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $id = $_POST['id'];
        $img = $_POST['img'];

        if(!empty($_FILES['image'])){
            $extension=strtolower(end(explode('.',$_FILES['image']['name'])));
            $file_name = substr(md5(microtime()),rand(0,26),10).uniqid().".".$extension;
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
      	  if(!empty($extension)){$image=$file_name;} else {$image = $img;}

      	  move_uploaded_file($file_tmp,$uploadpath.$file_name);
          $upload = mysqli_real_query($conn, "UPDATE business_admins SET photo='$image' where id = $id");
        } else{$image = $img; $upload = mysqli_real_query($conn, "UPDATE business_admins SET photo='$image' where id = $id");}

		$sql = "UPDATE business_admins SET name='$name', phone='$phone', email='$email' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "success";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    $_SESSION['success'] = "fail";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

endif;


if(!empty($_POST['pass_biz'])):

	$records = $connection->prepare('SELECT password FROM business_admins WHERE id = :id');
	$records->bindParam(':id', $_POST['id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	if(password_verify($_POST['password'], $results['password']) ){
        $newpass = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
        $id = $_POST['id'];

		$sql = "UPDATE business_admins SET password='$newpass' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "success";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    $_SESSION['success'] = "fail";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


	} else {
		$_SESSION['success'] = "fail";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

endif;

if(!empty($_POST['pass_biz2'])):
        $newpass = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
        $id = $_POST['id'];

		$sql = "UPDATE business_admins SET password='$newpass' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "success";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    $_SESSION['success'] = "fail";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

endif;

if(!empty($_POST['approve'])){
  $dur = "+".$_POST['duration'];
  $dt1 = new DateTime();
  $today = $dt1->format("Y-m-d");
  $dt2 = new DateTime("$dur month");
  $date = $dt2->format("Y-m-d");

  $id = $_POST['id'];
  $sql = "UPDATE business_admins SET status='1', exp_date='$date' WHERE id=$id";
  if ($conn->query($sql) === TRUE) {
      $_SESSION['success'] = "success";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
      $_SESSION['success'] = "fail";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if(!empty($_POST['disapprove'])){
  $dt1 = new DateTime("-1 day");
  $today = $dt1->format("Y-m-d");

  $id = $_POST['id'];
  $sql = "UPDATE business_admins SET status='0', exp_date='$today' WHERE id=$id";
  if ($conn->query($sql) === TRUE) {
      $_SESSION['success'] = "success";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
      $_SESSION['success'] = "fail";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
}


/*
echo mysqli_error($conn);
*/
?>

<html>
<body>
<H1>Access Denied!! <a href="/">Go home</a></H1>
</body>
</html>
