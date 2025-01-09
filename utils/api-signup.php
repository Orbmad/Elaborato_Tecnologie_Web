<?php
    require_once '../bootstrap.php';

    if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["signEmail"]) && isset($_POST["signPassword"]) && isset($_POST["confermaPassword"])) {
        $checkPassword = checkPassword($_POST["signPassword"]);
        if (!checkEmail($_POST["email"])) {
            $templateParams["erroreSignup"] = "Email non valida";
        } else if (($checkPassword === true)) {
            $templateParams["erroreSignup"] = $checkPassword;
        } else if ($_POST["signPassword"] != $_POST["confermaPassword"]) {
            $templateParams["erroreSignup"] = "Le due password non sono uguali";
        } else {
            $dbh->newUser($_POST["signEmail"], $_POST["nome"], $_POST["cognome"], $_POST["signPassword"]);
        }
    }

    require '../login.php';
?>