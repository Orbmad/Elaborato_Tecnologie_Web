<?php
    require_once '../bootstrap.php';

    $_SESSION["errorelogin"] = "flag";

    if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["signEmail"]) && isset($_POST["signPassword"]) && isset($_POST["confermaPassword"])) {
        $checkPassword = checkPassword($_POST["signPassword"]);
        if (!checkEmail($_POST["signEmail"])) {
            $_SESSION["errorelogin"] = "Email non valida";
        } else if (!($checkPassword === true)) {
            $_SESSION["errorelogin"] = $checkPassword;
        } else if ($_POST["signPassword"] != $_POST["confermaPassword"]) {
            $_SESSION["errorelogin"] = "Le due password non sono uguali";
        } else if ($dbh->checkExistingEmail($_POST["signEmail"])) {
            $_SESSION["errorelogin"] = "La email inserita è già associata ad un account";
        } else {
            $dbh->newUser($_POST["signEmail"], $_POST["nome"], $_POST["cognome"], $_POST["signPassword"]);
        }
    } else {
        $_SESSION["errorelogin"] = "Errore nella fase di registrazione";
    }

    if($_SESSION["errorelogin"] == "flag") {
        $_SESSION["msg"] = "Registrazione andata a buon fine";
    }

    header("Location: ../login.php");
    exit;
?>