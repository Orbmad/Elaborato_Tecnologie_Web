<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio";
$templateParams["js"] = array("js/index.js");

//Index template
$templateParams["randomArticles"] = $dbh->getArticles(3);
$templateParams["mainContent"] = "articles-slides.php";

require 'template/base.php';
?>