<?php
$templateParams["titolo"] = "Plantatio";
require_once 'bootstrap.php';
if(isset($_POST["dati"])){
    var_dump($_POST["dati"]);
}
if (isset($_SESSION["email"])) {
    $templateParams["js"] = array("js/nav.js", "js/header.js");
    $email = $_SESSION["email"];
}else{
    $templateParams["js"] = array("js/nav.js", "js/header.js");
}

$templateParams["mainContent"] = "template/main-processa-ordine.php";
require 'template/base.php';
?>