<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio";
$templateParams["js"] = array("js/index.js", "js/nav.js", "js/header.js");

//Index template
$templateParams["randomArticles"] = $dbh->getArticles(3);
$templateParams["mainContent"] = "main-index.php";
if (isAdminLoggedIn()) {
    array_push($templateParams["js"], "js/admin.js");
    $templateParams["mainContent"] = "admin-page.php";
}
$templateParams["randomCategories"] = $dbh->getRandomCategories(5);
$templateParams["searchResults"]= $dbh->getBestProducts(4);

require 'template/base.php';
?>