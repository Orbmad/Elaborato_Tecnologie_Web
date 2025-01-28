<?php
require_once 'bootstrap.php';
//Base Template
$templateParams["titolo"] = "Plantatio";

//Main content
$templateParams["mainContent"] = "user_notification.php";
$templateParams["js"] = array("js/nav.js", "js/header.js", "js/notification.js");

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['message'])) {
    $messageContent = $data['message'];
    $id_notifica = $data['id'];
    $dbh->changeStateOfAMessage($messageContent, $id_notifica, $_SESSION['email']);
}
/*Attualmente mostra */
//$idprodotto = 'Adiantum hispidulum';

//$templateParams["notifiche"] = $dbh->getReviewsOfProduct($idprodotto);

$templateParams["notifiche"] = $dbh->getNotificationOfAUser($_SESSION['email']);

require 'template/base.php';
?>