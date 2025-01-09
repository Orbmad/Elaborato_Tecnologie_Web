<?php
    require_once '../bootstrap.php';

    if(isset($_POST["email"]) && isset($_POST["password"])) {
        $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);
        if(count($login_result)==0) {
            //Login failed
            $_SESSION["errorelogin"] = "Email e/o password errati.";
        } else {
            registerLoggedUser($login_result[0]);
        }
    }

    if(isUserLoggedIn()) {
        if(isAdminLoggedIn()) {
            header("Location: ../admin.php");
            exit;
        } else {
            header("Location: ../index.php");
            exit;
        }
    } 


    header("Location: ../login.php");
    exit;
    //require 'template/base.php';
?>