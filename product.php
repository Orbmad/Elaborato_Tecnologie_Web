<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio";

//Main content
$templateParams["mainContent"] = "single-item.php";
$templateParams["js"] = array("js/product.js", "js/nav.js", "js/header.js");

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$idProd;

if (isset($data['productId'])) {
    $productId = $data['productId'];
    $quantity = $data['productQuant'];
    if(!empty($_SESSION['email'])){
        $dbh->addToCart($productId, $quantity, $_SESSION['email']);
    }
    $idProd = $productId;
}

//Home Template
$idprodotto = -1;
if(isset($_GET["idP"])){
    $idprodotto = getStringWithSpaces($_GET["idP"]);
} else {
    if(isset($idProd)){
        $idprodotto = $productId;
    }
}


/*per aprire la pagina relativa al singolo prodotto è necessario passare il suo ID per
poter prelevare dal DB le informazioni relative ad esso*/
$templateParams["prodotto"] = $dbh->getProductById($idprodotto);

$templateParams["recensioni_prodotto"] = $dbh->getReviewsOfProduct($idprodotto);

require 'template/base.php';
?>