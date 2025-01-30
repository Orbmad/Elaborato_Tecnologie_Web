<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio";

//Main content
$templateParams["mainContent"] = "main-order.php";
$templateParams["js"] = array("js/orders.js", "js/nav.js", "js/header.js");

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['productId'])) {
    $productId = $data['productId'];
    $rating = $data['rating'];
    $review = $data['review'];
    if(!empty($_SESSION['email'])){
        $dbh->addReview($_SESSION['email'], $productId, $rating, $review);
    }
}

$templateParams["orders"] = $dbh->getOrdersOfAUser($_SESSION['email']);



require 'template/base.php';
?>