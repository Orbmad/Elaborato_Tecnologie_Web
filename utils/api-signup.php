<?php
    require_once '../bootstrap.php';

    $string = "Location: ../login.php";

    if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["signEmail"]) && isset($_POST["signPassword"]) && isset($_POST["confermaPassword"])) {
        $checkPassword = checkPassword($_POST["signPassword"]);
        if (!checkEmail($_POST["signEmail"])) {
            $_SESSION["erroresignup"] = "Email non valida";

            $string .= "?ph_nome=" . $_POST["nome"];
            $string .= "&ph_cognome=" . $_POST["cognome"];
        } else if (!($checkPassword === true)) {
            $_SESSION["erroresignup"] = $checkPassword;

            $string .= "?ph_nome=" . $_POST["nome"];
            $string .= "&ph_cognome=" . $_POST["cognome"];
            $string .= "&ph_email=" . $_POST["signEmail"];
        } else if ($_POST["signPassword"] != $_POST["confermaPassword"]) {
            $_SESSION["erroresignup"] = "Le due password non sono uguali";

            $string .= "?ph_nome=" . $_POST["nome"];
            $string .= "&ph_cognome=" . $_POST["cognome"];
            $string .= "&ph_email=" . $_POST["signEmail"];
        } else if ($dbh->checkExistingEmail($_POST["signEmail"])) {
            $_SESSION["erroresignup"] = "La email inserita è già associata ad un account";

            $string .= "?ph_nome=" . $_POST["nome"];
            $string .= "&ph_cognome=" . $_POST["cognome"];
            $string .= "&ph_email=" . $_POST["signEmail"];
        } else {
            $dbh->newUser($_POST["signEmail"], $_POST["nome"], $_POST["cognome"], $_POST["signPassword"]);
            unset($_SESSION["erroresignup"]);
            $_SESSION["errorelogin"] = "Registrazione andata a buon fine!";
        }
    } else {
        $_SESSION["erroresignup"] = "Errore nella fase di registrazione";
    }

    header($string);
    exit;
?>