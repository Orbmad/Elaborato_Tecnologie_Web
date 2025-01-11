<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio - Admin";
$templateParams["js"] = array("");

if (isAdminLoggedIn()) { //RICORDATI DI INSERIRE IL PUNTO ESCLAMATIVO!!!!!!!!!!!(LHO TOLTO PER PROVA)
    header("Location: ./index.php");
    exit;
}

$templateParams["titolo"] = "Plantatio - Admin";
$templateParams["mainContent"] = "admin-page.php";

require 'template/base.php'
?>