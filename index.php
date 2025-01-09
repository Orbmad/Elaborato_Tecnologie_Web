<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio";
$templateParams["js"] = array("js/index.js", "js/nav.js");

//Index template
$templateParams["randomArticles"] = $dbh->getArticles(3);
$templateParams["mainContent"] = "main-index.php";
$templateParams["randomCategories"] = $dbh->getRandomCategories(2);

require 'template/base.php';
?>