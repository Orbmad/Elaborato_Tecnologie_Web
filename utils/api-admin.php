<?php
require_once '../bootstrap.php';

unset($_SESSION["msg"]);
unset($_SESSION["errore"]);

if (!(isset($_POST["queryType"]))) {
    $_SESSION["errore"] = "Errore nell'operazione effettuata, parametri non ricevuti".$_POST["queryType"];
} else if ($_POST["queryType"] == "inserisciprodotto" && isset($_FILES["immagine"])) {
    //Inserimento prodotto
    list($result, $msg) = uploadImage("../upload/prodotti/", $_FILES["immagine"], $_POST["nome_prodotto"]);
    if (!$result) {
        $_SESSION["errore"] = $msg;
    } else {
        if ($dbh->insertNewProduct(
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
            $_SESSION["msg"] = "Prodotto inserito";
        } else {
            $_SESSION["errore"] = "Errore inserimento prodotto";
        }
    }
} else if ($_POST["queryType"] == "creagruppo" /*&& isset($_FILES["immagine"])*/) {
    //Creazione gruppo
    list($result, $msg) = uploadImage("../upload/gruppi/", $_FILES["immagine"], $_POST["nomeGruppo"]);
    if (!$result) {
        $_SESSION["errore"] = $msg;
    } else {
        if ($dbh->createNewGroup(
            $_POST["nomeGruppo"],
            $_POST["descrizioneGruppo"]
        )) {
            $_SESSION["msg"] = "Gruppo creato";
        } else {
            $_SESSION["errore"] = "Errore creazione gruppo";
        }
    }
} else if ($_POST["queryType"] == "inserisciingruppo") {
    //Inserimento in gruppo
    if ($dbh->addProductInGroup(
        $_POST["nomeGruppo"],
        $_POST["nomeProdotto"]
    )) {
        $_SESSION["msg"] = "Prodotto inserito nel gruppo";
    } else {
        $_SESSION["errore"] = "Errore di inserimento";
    }
} else if ($_POST["queryType"] == "rimuovidagruppo") {
    //Rimozione da gruppo
    if ($dbh->removeProductFromGroup(
        $_POST["nomeGruppo"],
        $_POST["nome_prodotto"]
    )) {
        $_SESSION["msg"] = "Prodotto rimosso dal gruppo";
    } else {
        $_SESSION["errore"] = "Errore di rimozione";
    }
} else {
    $_SESSION["errore"] = "Errore nell'operazione effettuata, operazione non riconosciuta";
}

header("Location: ../admin.php");
exit;

?>