<main class="main-cart">
    <section class="cart-products">
        <?php if (isset($templateParams["cartProducts"])): ?>
            <?php if (count($templateParams["cartProducts"]) > 0): ?>
                <section class="cart-header">
                    <h2>
                        Il tuo carrello
                    </h2>
                    <input type="button" id="order-input" class="green-button <?php if (!isOrderEnabled($templateParams["cartProducts"])) { echo "disabled"; }?>" value="<?php if (!isOrderEnabled($templateParams["cartProducts"])) { echo "Disponibilità insufficiente"; } else { echo "Procedi all'ordine";} ?>" onclick="window.location.href='order.php'" />
                </section class="cart-header">

                <ul>
                    <?php foreach ($templateParams["cartProducts"] as $cartProduct): ?>
                        <li class="detail stock<?php echo $cartProduct["stock"]; ?> <?php echo str_replace(' ', '', $cartProduct['nome_prodotto']); ?>">
                            <img onclick="window.location.href='product.php?idP=<?php echo getSrc($cartProduct['nome_prodotto']) ?>'"
                                src="./upload/prodotti/<?php echo getSrc($cartProduct['nome_prodotto']) ?>.jpg" alt="Immagine del prodotto" />
                            <section class="product-description">
                                <h3 onclick="window.location.href='product.php?idP=<?php echo getSrc($cartProduct['nome_prodotto']) ?>'">
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
                                    echo "<p class='product-available'>Disponibilitá: disponibile (" . $cartProduct["stock"] . ")</p>";
                                }
                                ?>
                                <p><?php echo (strlen($cartProduct['descrizione']) > 353) ? substr($cartProduct['descrizione'], 0, 350) . '...' : $cartProduct['descrizione']; ?>
                                </p>

                                <!-- Bottoni quantità -->
                                <section class="article-actions">
                                    <section class="qt-selection">
                                        <?php if ($cartProduct["quantita"] == 1) {
                                            echo "<img src='./upload/bin.png' alt='Remove element image' class=\"" . $cartProduct['nome_prodotto'] . "\" onclick=\"productRemoveClicked(this, " . $cartProduct['quantita'] . ")\" />";
                                        } else {
                                            echo "<img src='./upload/minus.png' alt='Remove element image' class=\"" . $cartProduct['nome_prodotto'] . "\" onclick=\"productRemoveClicked(this, " . $cartProduct['quantita'] . ")\" />";
                                        } ?>

                                        <p><?php echo $cartProduct["quantita"] ?></p>

                                        <img src="./upload/add.png" alt="Add element image" class="<?php echo $cartProduct['nome_prodotto']; ?>"

                                            onclick="productAddClicked(this,<?php echo $cartProduct['quantita'] ?>)" />
                                    </section class="qt-selection">
                                    <a href="search.php?sottocategoriaSelezionata=<?php echo getSrc($cartProduct['id_sottocategoria']); ?>">Prodotti
                                        simili</a>
                                </section>

                            </section>
                            <section class="product-price">
                                <p><?php echo $cartProduct["prezzo"] ?>€</p>
                            </section>
                        </li>
                    <?php endforeach; ?>
                    <li>
                        <p>Articoli: <?php echo $templateParams["cartTotalProducts"] ?></p>
                        <p>Totale provvisorio: <?php echo $templateParams["cartTotalPrice"] ?> €</p>
                    </li>
                </ul>

            <?php else: ?>
                <h2>Il tuo carrello è vuoto</h2>
            <?php endif; ?>

        <?php else: ?>

            <section class="cart-header">
                <h2>Effettua il login per accedere al carrello...</h2>
            </section>
        <?php endif; ?>
    </section>
</main>