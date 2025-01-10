<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio";

//Main content
$templateParams["mainContent"] = "single-item.php";
$templateParams["js"] = array("js/product.js", "js/nav.js", "js/index.js");
//Home Template
$idprodotto = -1;
if(isset($_GET["id"])){
    $idprodotto = $_GET["id"];
}


/*per aprire la pagina relativa al singolo prodotto è necessario passare il suo ID per
poter prelevare dal DB le informazioni relative ad esso*/
$templateParams["prodotto"] = $dbh->getProductById($idprodotto);

$templateParams["recensioni_prodotto"] = $dbh->getReviewsOfProduct($idprodotto);

require 'template/base.php';
?>