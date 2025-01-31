<?php
require_once 'bootstrap.php';

//TemplateParams
$templateParams["titolo"] = "Plantatio - Indirizzi";
$templateParams["mainContent"] = "template/address-page.php";
$templateParams["addresses"] = $dbh->getUserAddresses($_SESSION["email"]);

$templateParams["js"] = array("js/header.js");

require 'template/base.php';
?>