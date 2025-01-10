<?php
require_once 'bootstrap.php';


$email = "michele.farneti23@gmail.com";

//Base Template
$templateParams["titolo"] = "Plantatio";
$templateParams["js"] = array("js/nav.js","js/cart.js");

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['removed'])) {
    $removedProductId = $data['removed'];
    $newProductQt = $data['productQt'];
    $dbh->changeCartProductQt($email,$removedProductId, $newProductQt);
} else if (isset($data['added'])) {
    $addedProductId = $data['added'];
    $newProductQt = $data['productQt'];
    $dbh->changeCartProductQt($email,$addedProductId, $newProductQt);
}


$templateParams["cartProducts"] = $dbh->getCartProducts($email);
$templateParams["cartTotalPrice"] = $dbh->getCartTotalPrice($email);
$templateParams["cartTotalProducts"] = $dbh->getCartTotalProducts($email);
$templateParams["mainContent"] = "main-cart.php";


require 'template/base.php';
?>