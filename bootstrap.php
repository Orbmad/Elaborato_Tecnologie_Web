<?php

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(900); //La sessione resta attiva per 15 minuti;
    session_start();
}

require_once("utils/functions.php");
require_once("database/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "plantatio", 3306);

//Template Params
$templateParams["categorie"] = $dbh->getCategories();
?>