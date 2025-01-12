<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio";
$templateParams["js"] = array("js/search.js", "js/nav.js", "js/header.js");

$templateParams["asideContent"] = "template/filter-panel.php";
if(isset($_GET['sottocategoriaSelezionata'])){
    $templateParams["searchedSubCategory"] = str_replace(' ','',$_GET['sottocategoriaSelezionata']);
    $templateParams["searchedCategory"] = str_replace(' ','', $dbh->getCategoryFromSubcategory($_GET['sottocategoriaSelezionata'])[0]["id_categoria"]);
    $templateParams["searchResults"] = $dbh->searchProductByName("");
}else if (isset($_GET['categoriaSelezionata'])) {
    $templateParams["searchedCategory"] = str_replace(' ','',$_GET['categoriaSelezionata']);
    $templateParams["searchResults"] = $dbh->searchProductByName("");
}else if(isset($_GET['gruppoSelezionato'])){
    $templateParams["searchedGroup"] = $_GET['gruppoSelezionato'];
    $templateParams["searchResults"] = $dbh->searchProductByName("");
}else if (isset($_GET['fastSearch'])) {
    $templateParams["searchedWord"] = $_GET['fastSearch'];
    $templateParams["searchResults"] = $dbh->searchProductByName($_GET['fastSearch']);
}

$updatedResults = [];
foreach ($templateParams["searchResults"] as $result) {
    $result["nomeGruppo"] = $dbh->getProductGroups($result["nome_prodotto"]);
    $updatedResults[] = $result;
}
$templateParams["searchResults"] = $updatedResults;
$templateParams["mainContent"] = "template/search-results.php";


$templateParams["priceRange"] = $dbh->getProductsPrinceRange();
$templateParams["attributesValues"] = $dbh->getProductsAttributesValues();
$templateParams["categorie"] = $dbh->getCategories();

require 'template/base.php';
?>