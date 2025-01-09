<?php
    require_once '../bootstrap.php';

    if(isset($_POST["email"]) && isset($_POST["password"])) {
        $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);
        if(count($login_result)==0) {
            //Login failed
            $templateParams["errorelogin"] = "Email e/o password errati.";
        } else {
            registerLoggedUser($login_result[0]);
        }
    }

    if(isUserLoggedIn()) {
        if(isAdminLoggedIn()) {
            header("Location: ../admin.php");
        } else {
            header("Location: ../index.php");
        }
    } else {
        header("Location: ../login.php");
    }
    
    //require 'template/base.php';
?>