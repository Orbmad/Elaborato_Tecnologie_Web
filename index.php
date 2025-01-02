<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio";
$templateParams["js"] = array("js/index.js");

//Home template
$templateParams["randomArticles"] = $dbh->getArticles(3);
$templateParams["slideShow"] = "articles-slides.php";

require 'template/base.php';
?>