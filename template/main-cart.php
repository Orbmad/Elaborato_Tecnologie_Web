<main class="main-cart">
    <section class="cart-products">
        <section class="cart-header">
            <h2>
                Il tuo carrello
            </h2>
            <input type="button"
                value="Procedi all'ordine (<?php echo $templateParams["cartTotalProducts"] ?>)" />
        </section class="cart-header">
        <ul>
            <?php foreach ($templateParams["cartProducts"] as $cartProduct): ?>
                <li>
                    <img onclick="window.location.href='product.php?id=<?php echo $cartProduct['nome_prodotto'] ?>'" src="./upload/prodotti/<?php echo $cartProduct['nome_prodotto'] ?>.jpg" alt="" />
                    <section class="product-description">
                        <h3 onclick="window.location.href='product.php?id=<?php echo $cartProduct['nome_prodotto'] ?>'">
                            <?php echo $cartProduct["nome_prodotto"] ?>
                        </h3>
                        <p>
                            <?php echo $cartProduct["nome_volgare"] ?>
                        </p>
                        <?php
                        if (intval($cartProduct["stock"]) == 0) {
                            echo "<p class='product-unavailable'>Disponibilitá: non disponibile</p>";
                        } else if (intval($cartProduct["stock"]) <= 5) {
                            echo "<p class='product-lowav'>Disponibilitá: soli " . $cartProduct["stock"] . "</p>";
                        } else {
                            echo "<p class='product-available'>Disponibilitá: disponibile</p>";
                        }
                        ?>
                        <p><?php echo (strlen($cartProduct['descrizione']) > 353) ? substr($cartProduct['descrizione'], 0, 350) . '...' : $cartProduct['descrizione']; ?>
                        </p>
                        <section class="article-actions">
                            <section class="qt-selection">
                                <?php if ($cartProduct["quantita"] == 1) {
                                    echo "<img src='./upload/bin.png' alt='Remove element image' id='" . $cartProduct['nome_prodotto'] . "' onclick=\"productRemoveClicked(this, " . $cartProduct['quantita'] . ")\" />";
                                } else {
                                    echo "<img src='./upload/minus.png' alt='Remove element image' id='" . $cartProduct['nome_prodotto'] . "' onclick=\"productRemoveClicked(this, " . $cartProduct['quantita'] . ")\" />";
                                } ?>
                                <p> <?php echo $cartProduct["quantita"] ?></p>
                                <img src="./upload/add.png" alt="Add element image"
                                    id="<?php echo $cartProduct["nome_prodotto"] ?>"
                                    onclick="productAddClicked(this,<?php echo $cartProduct['quantita'] ?>)" />
                            </section class="qt-selection">
                            <a href="search.php?sottocategoriaSelezionata=<?php echo $cartProduct['id_sottocategoria']; ?>">Prodotti
                                simili</a>
                        </section>
                    </section>
                    <section class="product-price">
                        <p><?php echo $cartProduct["prezzo"] ?>€</p>
                    </section>
                </li>
            <?php endforeach; ?>
            <li>
                <p>Totale provvisorio: <?php echo $templateParams["cartTotalPrice"] ?>€</p>
            </li>
        </ul>
    </section>
</main>