<?php
require_once '../bootstrap.php';

$dbh->deleteUserAddress($_SESSION["email"], $_POST["address_id"]);

header("Location: ../address.php");
exit;
?>