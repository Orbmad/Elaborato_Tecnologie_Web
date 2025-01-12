<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Plantatio";

if (isset($_SESSION["email"])) {
    $templateParams["js"] = array("js/nav.js", "js/cart.js", "js/header.js");
    $email = $_SESSION["email"];
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['removed'])) {
        $removedProductId = $data['removed'];
        $newProductQt = $data['productQt'];
        $dbh->changeCartProductQt($email, $removedProductId, $newProductQt);
    } else if (isset($data['added'])) {
        $addedProductId = $data['added'];
        $newProductQt = $data['productQt'];
        $dbh->changeCartProductQt($email, $addedProductId, $newProductQt);
    }


    $templateParams["cartProducts"] = $dbh->getCartProducts($email);
    $templateParams["cartTotalPrice"] = $dbh->getCartTotalPrice($email);
    $templateParams["cartTotalProducts"] = $dbh->getCartTotalProducts($email);
    $templateParams["mainContent"] = "main-cart.php";

}else{
    $templateParams["js"] = array("js/nav.js", "js/header.js");
    $templateParams["mainContent"] = "main-cart.php";
}

require 'template/base.php';
?>