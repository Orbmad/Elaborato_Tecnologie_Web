<?php
require_once 'bootstrap.php';

$templateParams["mainContent"] = "template/main-orderConfirmation.php";
$templateParams["titolo"] = "Plantatio";

if (isset($_SESSION["email"])) {
    $templateParams["js"] = array("js/nav.js", "js/order.js", "js/header.js");
    $email = $_SESSION["email"];
    $templateParams["cartProducts"] = $dbh->getCartProducts($email);
    $templateParams["cartTotalPrice"] = $dbh->getCartTotalPrice($email);
    $templateParams["cartTotalProducts"] = $dbh->getCartTotalProducts($email);
    $templateParams["savedAddresses"] = $dbh->ge
}else{
    $templateParams["js"] = array("js/nav.js", "js/header.js");
}

$templateParams["mainContent"] = "template/main-orderConfirmation.php";
$templateParams["paymentsMethods"] = $dbh->getPaymentMethods();
require 'template/base.php';
?>