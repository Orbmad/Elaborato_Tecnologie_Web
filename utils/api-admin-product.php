<?php
require_once '../bootstrap.php';

unset($_SESSION["msg"]);
unset($_SESSION["errore"]);

if (!isset($_POST["queryType"])) {
    $_SESSION["errore"] = "Errore nell'operazione effettuata, parametri non ricevuti" . $_POST["queryType"];
} else if ($_POST["queryType"] == "gestione-prodotto") {
    if (isset($_POST["modifica"])) {
        if ($dbh->updateProduct(
            $_POST["nome_prodotto"],
            $_POST["prezzo"],
            $_POST["nome_sottocategoria"],
            $_POST["stock"],
            $_POST["nome_volgare"],
            $_POST["nome_scientifico"],
            $_POST["famiglia"],
            $_POST["genere"],
            $_POST["specie"],
            $_POST["dimensioni"],
            $_POST["profumo"],
            $_POST["tipologia_foglia"],
            $_POST["colore_foglia"],
            $_POST["descrizione"]
        )) {
            //Modifica prodotto
            $_SESSION["msg"] = "Prodotto modificato";
            if ($_POST["stock"] == 0) {
                $targetUsers = $dbh->getUsersWithProductInCart($_POST["id"]);
                foreach ($targetUser as $user) {
                    $dbh->newNotification($user["email"], "Il prodotto " . $_POST["nome_prodotto"] . "presente nel tuo carrello non è più disponibile.");
                }
            }
        } else {
            $_SESSION["errore"] = "Errore: impossibile modificare il prodotto";
        }
    } else if (isset($_POST["elimina"])) {
        //Cancellazione prodotto
        $dbh->deleteProduct($_POST["elimina"]);
        $_SESSION["msg"] = "Prodotto eliminato";
        $dbh->removeDeletedProductFromCarts($_POST["id"]);
        $targetUsers = $dbh->getUsersWithProductInCart($_POST["id"]);
        foreach ($targetUser as $user) {
            $dbh->newNotification($user["email"], "Il prodotto " . $_POST["nome_prodotto"] . "presente nel tuo carrello è stato rimosso.");
        }
    }
} else {
    $_SESSION["errore"] = "Errore nell'operazione effettuata, operazione non riconosciuta";
}

header("Location: ../admin.php?id=" . $_POST["id"]);
exit;
