<?php
$templateParams["titolo"] = "Plantatio";
require_once 'bootstrap.php';
$dati = json_decode(file_get_contents("php://input"), true);
echo var_dump($dati);
?>