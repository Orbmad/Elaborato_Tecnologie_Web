<?php
require_once 'bootstrap.php';


$email = "utenteProva";

//Base Template
$templateParams["titolo"] = "Plantatio";
$templateParams["js"] = array("js/index.js", "js/nav.js");

//Index template
//$templateParams["cartArticles"] = $dbh->getCartArticles($email);
$templateParams["mainContent"] = "main-cart.php";


require 'template/base.php';
?>