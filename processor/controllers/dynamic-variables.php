<?php
//Branding and SEO variables
$brandname = "Brynlabs";#ike_fetchspecificvariable("brand", "brand_name", "where id='1'");
$brandnameHTML = "Brynlabs";#ike_fetchspecificvariable("brand", "brand_name_html", "where id='1'");
$description = "Brynlabs Template";#ike_fetchspecificvariable("brand", "description", "where id='1'");
$keywords = "Brynlabs Template";#ike_fetchspecificvariable("brand", "keywords", "where id='1'");
$brandlogo = "logo.png";#ike_fetchspecificvariable("brand", "image", "where id='1'");
$icon = "icon.png";#ike_fetchspecificvariable("brand", "image2", "where id='1'");
$brandlogo2 = "logo.png";#ike_fetchspecificvariable("brand", "image3", "where id='1'");
$seoimage = "seo.png";#ike_fetchspecificvariable("brand", "image4", "where id='1'");
$slogan = "logo.png";#ike_fetchspecificvariable("brand", "slogan", "where id='1'");


if(!empty($_GET["theme_c"])){
  $theme_a = $_GET["theme_c"];
}else{
  $theme_a = "";
}
$admin_theme = "";#ike_fetchspecificvariable("themes", "theme", "where theme='$theme_a'");


?>
