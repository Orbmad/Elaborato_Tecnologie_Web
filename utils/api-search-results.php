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
$minprice = $data['prezzomin'];
$maxprice = $data['prezzomax'];
$minrating = $data['ratingmin'];
$text = $data['text'];

$products = $dbh->getFilteredProducts($categoriesChecked, $groupsChecked, $famigliaChecked, $profumoChecked, $colore_fogliaChecked, $tipologia_fogliaChecked,$minprice,$maxprice,$minrating,$text);

// Se $products è un array o un oggetto, puoi restituire il risultato come HTML
$productListHTML = '';  // Inizializza la variabile HTML

foreach ($products as $product) {
    $productListHTML .= "<li>
        <a href='product.php?idP=" . getSrc($product['nome_prodotto']) . "'>
            <img src='./upload/prodotti/" . getSrc($product['nome_prodotto']) . ".jpg' class='product-image' alt='product image' />
            <h2>" . htmlspecialchars($product["nome_prodotto"]) . "</h2>
            <p>" . $product["prezzo"] . " €</p>
            <p>";

    $voto = (int) $product["voto"];
    for ($i = 1; $i <= 5; $i++) {
        $productListHTML .= $i <= $voto ? '<span class="fa fa-star checked"></span>' : '<span class="fa fa-star"></span>';
    }

    $productListHTML .= "</p>";

    if (isset($_SESSION["email"]) && $dbh->hasUserProductInCart($_SESSION["email"], $product['nome_prodotto'])) {
        $productListHTML .= "<img src='./upload/Card-Cart-Icon.png' class='cart-icon' alt='articolo presente nel carrello' />";
    }

    $productListHTML .= "</a></li>";
}

if(strlen($productListHTML)==0){
    $productListHTML .= "<p> Nessun prodotto corrisponde ai criteri di ricerca</p>";
}

if($productListHTML)
// Restituisci la risposta in formato JSON
echo json_encode([
    'productListHTML' => $productListHTML,  // HTML generato per la lista dei prodotti
]);

?>