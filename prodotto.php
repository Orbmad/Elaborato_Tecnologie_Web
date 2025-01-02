<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio";
$templateParams["nome"] = "singolo-prodotto.php";

//Home Template
$idprodotto = -1;
if(isset($_GET["id"])){
    $idprodotto = $_GET["id"];
}
$templateParams["prodotto"] = $dbh->getProductById($idprodotto);

require 'template/base.php';
?>