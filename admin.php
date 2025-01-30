<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio - Admin";
$templateParams["js"] = array("js/admin.js", "js/nav.js");

if (!isAdminLoggedIn()) {
    header("Location: ./index.php");
    exit;
}

$templateParams["titolo"] = "Plantatio - Admin";
$templateParams["mainContent"] = "admin-page.php";

require 'template/base.php'
?>