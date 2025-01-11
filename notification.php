<?php
require_once 'bootstrap.php';
//Base Template
$templateParams["titolo"] = "Plantatio";

//Main content
$templateParams["mainContent"] = "user_notification.php";
$templateParams["js"] = array("js/nav.js", "js/index.js", "js/notification.js");

$idprodotto = 'Adiantum hispidulum';

$templateParams["notifiche"] = $dbh->getReviewsOfProduct($idprodotto);

//$templateParams["notifiche"] = $dbh->getNotificationOfAUser($_SESSION['email']);

require 'template/base.php';
?>