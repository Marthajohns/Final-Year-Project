<?php

$liveserver = 0;
$rootlink = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
$rootlink_less = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
$currentlink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
						 "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
						 $_SERVER['REQUEST_URI'];

$folder = $_SERVER['REQUEST_URI']; //returns the current URL
             $parts = explode('/',$folder);
             $dir = $_SERVER['SERVER_NAME'];
             for ($i = 0; $i < count($parts) - 1; $i++) {
              $dir .= $parts[$i] . "/";
             }

$dashboard = "dashboard/";
$images = "uploads/";
$images_p = "../uploads/";
$r = "./";
$message="";

 ?>
