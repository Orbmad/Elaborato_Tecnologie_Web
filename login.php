<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio - login";
$templateParams["js"] = array("js/login.js");

//Main content
$templateParams["mainContent"] = "login-form.php";


require 'template/base.php';
?>