<?php
$templateParams["titolo"] = "Plantatio";
require_once 'bootstrap.php';
$dati = json_decode(file_get_contents("php://input"), true);
if(isset($dati)){
    if(isset($dati["datiIndirizzo"]["idIndirizzo"])){
            echo $dbh->createOrderFromCart(
            $dati["user"],
            $dati["metodoPagamento"],
            $dati["datiIndirizzo"]["idIndirizzo"],
            $dati["totalPrice"]);
    }else{
        echo $dbh->createOrderFromCart_addressNotSaved(
            $dati["user"],
            $dati["metodoPagamento"],
            $dati["datiIndirizzo"]["via"],
            $dati["datiIndirizzo"]["citta"],
            $dati["datiIndirizzo"]["provincia"],
            $dati["datiIndirizzo"]["cap"],
            $dati["datiIndirizzo"]["nazione"],
            $dati["totalPrice"],
            $dati["datiIndirizzo"]["save"]
        );
    }
}
?>