<?php
require_once '../bootstrap.php';
    $text = $_GET['text'] ?? '';
    $n = intval($_GET['n'] ?? 3);
    $suggestions = $dbh->getSuggestions($n, $text);
    header('Content-Type: application/json');
    echo json_encode($suggestions);
?>