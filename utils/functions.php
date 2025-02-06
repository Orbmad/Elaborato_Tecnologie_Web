<?php

/**
 * Restituisce la stringa passata dopo aver sostituito gli spazi con dei trattini.
 */
function replaceSpacesWithHyphens($string)
{
    $temp = $string;
    $newString = str_replace(' ', '-', $temp);
    return $newString;
}

function createArticle($groupInfo)
{
    $article = "
    <article>
        <h2 class='hidden'>Gruppo di prodotti </h2>
        <img src='upload/gruppi/" . getSrc($groupInfo["nomeGruppo"]) . ".jpg' alt='Immagine articolo'/>
        <section class='article-body'>
            <h2>" . $groupInfo["nomeGruppo"] . "</h2>
            <p>" . $groupInfo["descrizioneGruppo"] . "</p>
            <section class='button-sec'>
                <h2 class='hidden'>Sezione bottoni</h2>
                <input type='button' value='SCOPRI ARTICOLI' onclick=\"window.location.href='./search.php?gruppoSelezionato=" . urlencode($groupInfo['nomeGruppo']) . "'\"/>
            </section>
        </section>
    </article>";
    return $article;
}

function generateProductBox($productInfo, $cartSign)
{
    $productName = htmlspecialchars($productInfo['nome_prodotto']);
    $productPrice = htmlspecialchars($productInfo['prezzo']);
    $productRating = intval($productInfo['voto']);

    $stars = '';
    for ($i = 1; $i <= $productRating; $i++) {
        $stars .= '<span class="fa fa-star checked"></span>';
    }
    for ($i = $productRating + 1; $i <= 5; $i++) {
        $stars .= '<span class="fa fa-star"></span>';
    }

    if ($cartSign) {
        $productBox = "
        <li>
            <a href=\"product.php?idP=" . urlencode($productName) . "\">
                <img src=\"upload/prodotti/" . getSrc($productName) . ".jpg\" class='product-image' alt='product image' />
                <h2>" . $productName . "</h2>
                <p>" . $productPrice . " €</p>
                <p>" . $stars . "</p>
                <img src='./upload/Card-Cart-Icon.png' class='cart-icon' alt='articolo presente nel carrello' />
            </a>
        </li>
        ";
    } else {
        $productBox = "
        <li>
            <a href=\"product.php?idP=" . urlencode($productName) . "\">
                <img src=\"upload/prodotti/" . getSrc($productName) . ".jpg\" class='product-image' alt='product image' />
                <h2>" . $productName . "</h2>
                <p>" . $productPrice . " €</p>
                <p>" . $stars . "</p>
            </a>
        </li>
        ";
    }

    return $productBox;
}


function generateCAtegoryBox($categoryInfo)
{
    $categoryBox = "
        <li>
            <img src=\"upload/categorie/" . getSrc($categoryInfo["nome_categoria"]) . ".jpg\" alt='" . $categoryInfo['nome_categoria'] . " image' />
            <section>
                <h2 class='hidden'>Titolo Categoria</h2>
                <form action='search.php' method='GET'>
                    <label for='box-" .  str_replace(' ', '', $categoryInfo["nome_categoria"]). "'>" . $categoryInfo["nome_categoria"] . "</Label>
                    <input type='text' id='box-" .  str_replace(' ', '', $categoryInfo["nome_categoria"]) . "' name='categoriaSelezionata' value='" . $categoryInfo["nome_categoria"] . "' readonly />
                    <input type='submit' value='SCOPRI' />
                </form>
            </section>
        </li>
    ";

    return $categoryBox;
}

/**
 * Register the user in the current session.
 */
function registerLoggedUser($user)
{
    $_SESSION["email"] = $user["email"];
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["cognome"] = $user["cognome"];
    $_SESSION["admin_flag"] = $user["admin_flag"];
}

/**
 * Returns true if the user is logged in the active session.
 */
function isUserLoggedIn()
{
    return !empty($_SESSION['email']);
}

/**
 * Returns true if the logged user is an admin.
 */
function isAdminLoggedIn()
{
    return (isUserLoggedIn() && $_SESSION["admin_flag"]);
}

/**
 * Returns true if the email is correct.
 */
function checkEmail($email)
{

    $email = trim($email);

    if (empty($email)) {
        return false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    return true;
}

function checkPassword($password)
{
    // Controlla la lunghezza (minimo 8 caratteri)
    if (strlen($password) < 8) {
        return "La password deve contenere almeno 8 caratteri.";
    }

    // Controlla la presenza di almeno una lettera maiuscola
    if (!preg_match('/[A-Z]/', $password)) {
        return "La password deve contenere almeno una lettera maiuscola.";
    }

    // Controlla la presenza di almeno una lettera minuscola
    if (!preg_match('/[a-z]/', $password)) {
        return "La password deve contenere almeno una lettera minuscola.";
    }

    // Controlla la presenza di almeno un numero
    if (!preg_match('/[0-9]/', $password)) {
        return "La password deve contenere almeno un numero.";
    }

    // Controlla la presenza di almeno un carattere speciale
    if (!preg_match('/[\W_]/', $password)) {
        return "La password deve contenere almeno un carattere speciale (!@#$%^&*...).";
    }

    return true; //Password sicura
}

function addToCartIfUserIsLogged($id_prodotto, $quantità, $dbh)
{
    if (isUserLoggedIn()) {
        $dbh->addToCart($id_prodotto, $quantità);
    }
}

/*Verifica se la notifica è stata letta oppure no*/
function notificationNotRead($messaggio, $data_notifica, $id_notifica, $dbh)
{
    return $dbh->checkIfAMessageWasRead($messaggio, $data_notifica, $id_notifica, $_SESSION['email']);
}

function numberOfMessagesNotRead($dbh)
{
    if (!empty($_SESSION['email']))
        return $dbh->getNumberOfMessagesNotRead($_SESSION['email']);
    else
        0;
}

/**
 * Uploads an image in local directory.
 */
function uploadImage($path, $image, $newFileName)
{
    //$newFileName = preg_replace("/[^a-zA-Z0-9_-]/", "", $newFileName);
    $imageName = basename($image["name"]);
    $fullPath = $path . $imageName;

    $maxKB = 1000;
    $acceptedExtensions = array("jpg");
    $result = false;
    $msg = "";

    //Controllo che il file sia una immagine
    $imageSize = getimagesize($image["tmp_name"]);
    if ($imageSize === false) {
        $msg = "Errore: il file caricato non è una immagine";
        return array($result, $msg);
    }
    //Controllo la dimensione dell'immagine
    if ($image["size"] > $maxKB * 1024) {
        $msg = "Errore: l'immagine caricata è troppo grande";
        return array($result, $msg);
    }
    //Controllo l'estensione del file
    $imageFileType = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $acceptedExtensions)) {
        $msg = "Errore: estensione della immagine non supportata";
        return array($result, $msg);
    }
    //Rinomino il file
    $fullPath = $path . $newFileName . "." . $imageFileType;

    //Carico il file nella directory (Se già presente viene sovrascritto)
    if (!move_uploaded_file($image["tmp_name"], $fullPath)) {
        $msg = "Errore: impossibile caricare l'immagine in: " . $fullPath . " --> tmp: " . $image["tmp_name"] . " >Error: " . $image["error"];
        return array($result, $msg);
    } else {
        $result = true;
        $msg = "Immagine caricata";
    }

    return array($result, $msg);
}

function getProductsOfAOrder($order, $dbh)
{
    return $dbh->getItemsInAnOrder($order);
}

function hasUserLeftAReviewForProduct($dbh, $id_prodotto)
{
    return $dbh->hasUserLeftAReviewForProduct($_SESSION['email'], $id_prodotto);
}

function getSrc($string)
{
    $src_string = str_replace(' ', '_', $string);
    return $src_string;
}

function getStringWithSpaces($string)
{
    $id_string = str_replace('_', ' ', $string);
    return $id_string;
}

function isOrderEnabled($cartProducts) {
    foreach ($cartProducts as $product) {
        if ($product["quantita"] > $product["stock"]) {
            return false;
        }
    }
    return true;
}