<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio";
$templateParams["js"] = array("js/search.js");

$templateParams["asideContent"] = "template/filter-panel.php";
if (isset($_GET['categoriaSelezionata'])) {
    $templateParams["searchedCategory"] = str_replace(' ','',$_GET['categoriaSelezionata']);
    $templateParams["searchResults"] = $dbh->searchProductByName("");
    $templateParams["mainContent"] = "template/search-results.php";
}else if (isset($_GET['fastSearch'])) {
    $templateParams["searchedWord"] = $_GET['fastSearch'];
    $templateParams["searchResults"] = $dbh->searchProductByName($_GET['fastSearch']);
    $templateParams["mainContent"] = "template/search-results.php";
}


$templateParams["priceRange"] = $dbh->getProductsPrinceRange();
$templateParams["famiglia"] = $dbh->getProductsAttributeValues("famiglia");
$templateParams["genere"] = $dbh->getProductsAttributeValues("genere");
$templateParams["specie"] = $dbh->getProductsAttributeValues("specie");
$templateParams["dimensioni"] = $dbh->getProductsAttributeValues("dimensioni");
$templateParams["profumo"] = $dbh->getProductsAttributeValues("profumo");
$templateParams["tipo di foglia"] = $dbh->getProductsAttributeValues("tipologia_foglia");
$templateParams["colore delle foglie"] = $dbh->getProductsAttributeValues("colore_foglia");
$templateParams["voto"] = $dbh->getProductsAttributeValues("voto");
//$templateParams["categorie"] = $categories;
$templateParams["categorie"] = $dbh->getCategories();

require 'template/base.php';
?>