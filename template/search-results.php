<main class="search-results-main">
    <ul class="search-results-list">
        <?php
        foreach ($templateParams["searchResults"] as $result):
            $result["id_sottocategoria"] = str_replace(' ', '', $result["id_sottocategoria"]);
            $result["famiglia"] = str_replace(' ', '', $result["famiglia"]);
            $result["tipologia_foglia"] = str_replace(' ', '', $result["tipologia_foglia"]);
            $result["colore_foglia"] = str_replace(' ', '', $result["colore_foglia"]);
            $result["profumo"] = str_replace(' ', '', $result["profumo"]);
            ?>
            <li>
                <a href="product.php?idP=<?php echo getSrc($result['nome_prodotto']) ?>">
                    <img src="./upload/prodotti/<?php echo getSrc($result['nome_prodotto']) ?>.jpg" class="product-image"
                        alt="product image" />
                    <h2><?php echo $result["nome_prodotto"] ?></h2>
                    <p><?php echo $result["prezzo"] ?> €</p>
                    <p>
                        <?php
                        $voto = $result["voto"];
                        for ($i = 1; $i <= $voto; $i++) {
                            echo '<span class="fa fa-star checked"></span>';
                        }
                        for ($i = $voto + 1; $i <= 5; $i++) {
                            echo '<span class="fa fa-star"></span>';
                        }
                        ?>
                    </p>
                    <?php if (isset($_SESSION["email"]) && $dbh->hasUserProductInCart($_SESSION["email"], $result['nome_prodotto'])): ?>
                        <img src='./upload/Card-Cart-Icon.png' class='cart-icon' alt='articolo presente nel carrello' />
                    <?php endif; ?>
                </a>
            </li>
            <?php
        endforeach;
        ?>
    </ul>
</main>