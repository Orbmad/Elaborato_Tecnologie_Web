<?php
//Template used to insert login-form into main.

require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio - login";
$templateParams["js"] = array("js/login.js", "js/nav.js", "js/index.js");

//Main content
$templateParams["mainContent"] = "login-form.php";


require 'template/base.php';
?>