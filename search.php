<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio";
$templateParams["js"] = array("js/search.js");

$templateParams["asideContent"] = "template/filter-panel.php";
$templateParams["priceRange"] = $dbh->getProductsPrinceRange();
$templateParams["famiglia"] = $dbh->getProductsAttributeValues("famiglia");
$templateParams["genere"] = $dbh->getProductsAttributeValues("genere");
$templateParams["specie"] = $dbh->getProductsAttributeValues("specie");
$templateParams["dimensioni"] = $dbh->getProductsAttributeValues("dimensioni");
$templateParams["profumo"] = $dbh->getProductsAttributeValues("profumo");
$templateParams["tipo di foglia"] = $dbh->getProductsAttributeValues("tipologia_foglia");
$templateParams["colore delle foglie"] = $dbh->getProductsAttributeValues("colore_foglia");
$templateParams["categoria"] = $dbh->getCategories();

require 'template/base.php';
?>