<?php
require_once 'bootstrap.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['text'] ?? '';
    $n = intval($_POST['n'] ?? 3);
    $suggestions = $db->getSuggestions($n, $text);
    header('Content-Type: application/json');
    echo json_encode($suggestions);
}
?>