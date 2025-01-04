<?php
session_start();
require_once("utils/functions.php");
require_once("database/database.php");

//JS scripts
$templateParams["js"] = array();
array_push($templateParams["js"], "js/nav.js");

/*Provvisorio per i test*/
require_once("dummyTemplateParams.php");

$dbh = new DatabaseHelper("localhost", "root", "", "Plantatio", 3306);
?>