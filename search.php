<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio";
$templateParams["js"] = array("js/search.js");

$templateParams["asideContent"] = "template/filter-panel.php";
$templateParams["priceRange"] = $dbh->getProductsPrinceRange();
$templateParams["family"] = $dbh->getProductsAttributeValues("famiglia");
$templateParams["genre"] = $dbh->getProductsAttributeValues("genere");
$templateParams["spiece"] = $dbh->getProductsAttributeValues("specie");
$templateParams["dimensions"] = $dbh->getProductsAttributeValues("dimensioni");
$templateParams["perfume"] = $dbh->getProductsAttributeValues("profumo");
$templateParams["leafType"] = $dbh->getProductsAttributeValues("tipologia_foglia");
$templateParams["leafColors"] = $dbh->getProductsAttributeValues("colore_foglia");

require 'template/base.php';
?>