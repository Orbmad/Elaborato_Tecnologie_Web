<?php
require_once 'bootstrap.php';


$email = "michele.farneti23@gmail.com";

//Base Template
$templateParams["titolo"] = "Plantatio";
$templateParams["js"] = array("js/nav.js");

//Index template
$templateParams["cartProducts"] = $dbh->getCartProducts($email);
$templateParams["cartTotalPrice"] = $dbh->getCartTotalPrice($email);
$templateParams["mainContent"] = "main-cart.php";


require 'template/base.php';
?>