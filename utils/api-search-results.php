<?php
include '../bootstrap.php';
$data = json_decode(file_get_contents('php://input'), true);

// Ottieni i valori dai dati JSON
$categoriesChecked = $data['categoriesChecked'];
$groupsChecked = $data['groupsChecked'];
$famigliaChecked = $data['famiglia'];
$profumoChecked = $data['profumo'];
$colore_fogliaChecked = $data['colore_foglia'];
$tipologia_fogliaChecked = $data['tipologia_foglia'];

$products = $dbh->getFilteredProducts($categoriesChecked, $groupsChecked, $famigliaChecked,$profumoChecked,$colore_fogliaChecked,$tipologia_fogliaChecked);

// Se $products è un array o un oggetto, puoi restituire il risultato come HTML
$productListHTML = '';  // Inizializza la variabile HTML

$productListHTML = $products;
// foreach ($products as $product) {
//     // Aggiungi i dettagli del prodotto all'HTML
//     $productListHTML .= "<li>{$product['name']} - {$product['price']}</li>"; // Adatta secondo le tue necessità
// }

// Restituisci la risposta in formato JSON
echo json_encode([
    'productListHTML' => $productListHTML,  // HTML generato per la lista dei prodotti
]);

?>

