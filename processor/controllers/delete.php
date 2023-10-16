<?php
include("db.php");
if(!empty($_GET['id'])  && !empty($_GET['p'])){
  $id = $_GET['id'];
  $t = $_GET['p'];

  switch ($t) {
    case "v1":
        $table ="user_admins";
        break;
    case "v2":
        $table ="category";
        break;
    case "v3":
        $table ="sub_category";
        break;
    case "ve1de1279":
        $table ="basics";
        break;
    case "ve2de1603":
        $table ="main_content";
        break;
    case "ve7de1735":
        $table ="videos";
        case "dep":
            $table ="departments";
        break;
    case "ve3de1892":
        $table ="tblproduct";
        break;
    default:
        $table ="";
}

      $table = $_GET['tsec'];
    if ($table == "category"){$code = $_GET['c'];

                              $result2 = mysqli_query($conn, "DELETE FROM sub_category WHERE code='$code'");
                              $result = mysqli_query($conn, "DELETE FROM $table WHERE id=$id");
                              $result3 = mysqli_query($conn, "DELETE FROM rodmon WHERE cat='$code'");
                              $result4 = mysqli_query($conn, "DELETE FROM sub WHERE subcode=$code");
                             }
         elseif($table == "sub_category"){$code = $_GET['c'];
                              $result = mysqli_query($conn, "DELETE FROM $table WHERE id=$id");
                              $result3 = mysqli_query($conn, "DELETE FROM rodmon WHERE subcat='$code'");
                             }
         else{$result = mysqli_query($conn, "DELETE FROM $table WHERE id=$id");}

header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if(!empty($_GET["delete"])){
  $item = $_GET["delete"];
        unlink($item);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
}
if(!empty($_GET["delete2"])){
  $item = $_GET["delete2"];
        unlink($item);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
}
 ?>
