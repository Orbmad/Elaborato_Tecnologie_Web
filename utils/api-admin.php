<?php
require_once '../bootstrap.php';

unset($_SESSION["msg"]);
unset($_SESSION["errore"]);

if (!(isset($_GET["queryType"]))) {
    $_SESSION["errore"] = "Errore nell'operazione effettuata";
} else if ($_GET["queryType"] == "inserisci-prodotto") {
    //Inserimento prodotto
    if ($dbh->insertNewProduct(
        $_GET["nome_prodotto"],
        $_GET["prezzo"],
        $_GET["id_sottocategoria"],
        $_GET["stock"],
        $_GET["nome_volgare"],
        $_GET["nome_scientifico"],
        $_GET["famiglia"],
        $_GET["genere"],
        $_GET["specie"],
        $_GET["dimensioni"],
        $_GET["profumo"],
        $_GET["tipologia_foglia"],
        $_GET["colore_foglia"],
        $_GET["descrizione"]
    )) {
        $_SESSION["msg"] = "Prodotto inserito";
    } else {
        $_SESSION["errore"] = "Errore inserimento prodotto";
    }
} else if ($_GET["quertType"] == "crea-gruppo") {
    //Creazione gruppo
    if ($dbh->createNewGroup(
        $_GET["nome_gruppo"],
        $_GET["descrizione"]
    )) {
        $_SESSION["msg"] = "Gruppo creato";
    } else {
        $_SESSION["errore"] = "Errore creazione gruppo";
    }
} else if ($_GET["quertType"] == "inserisci-in-gruppo") {
    //Inserimento in gruppo
    if ($dbh->addProductInGroup(
        $_GET["nome_gruppo"],
        $_GET["nome_prodotto"]
    )) {
        $_SESSION["msg"] = "Prodotto inserito nel gruppo";
    } else {
        $_SESSION["errore"] = "Errore di inserimento";
    }
} else if ($_GET["quertType"] == "rimuovi-da-gruppo") {
    //Rimozione da gruppo
    if ($dbh->removeProductFromGroup(
        $_GET["nome_gruppo"],
        $_GET["nome_prodotto"]
    )) {
        $_SESSION["msg"] = "Prodotto rimosso dal gruppo";
    } else {
        $_SESSION["errore"] = "Errore di rimozione";
    }
} else {
    $_SESSION["errore"] = "Errore nell'operazione effettuata";
}

header("Location: ../admin.php");
exit;
