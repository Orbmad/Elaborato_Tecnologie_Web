<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Plantatio";

//Main content
$templateParams["mainContent"] = "singolo-prodotto.php";
$templateParams["js"] = array("js/product.js");
//Home Template
$idprodotto = -1;
if(isset($_GET["id"])){
    //$idprodotto = $_GET["id"];
}

$idprodotto = "Adiantum hispidulum";/*capire perchè se lo passo da URL in nome non va*/

/*per aprire la pagina relativa al singolo prodotto è necessario passare il suo ID per
poter prelevare dal DB le informazioni relative ad esso*/
$templateParams["prodotto"] = $dbh->getProductById($idprodotto);

require 'template/base.php';
?>