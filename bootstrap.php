<?php
session_start();
require_once("utils/functions.php");
require_once("database/database.php");

/*Provvisorio per i test*/
require_once("dummyTemplateParams.php");

$dbh = new DatabaseHelper("localhost", "root", "CapitaineMarleau0011!", "Plantatio", 3307);
?>