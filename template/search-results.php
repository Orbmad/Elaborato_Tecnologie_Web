<main class="search-results-main">
    <ul class="search-results-list">
        <?php
        foreach ($templateParams["searchResults"] as $result):
            $result["id_sottocategoria"] = str_replace(' ', '', $result["id_sottocategoria"]);
            $result["famiglia"] = str_replace(' ', '', $result["famiglia"]);
            $result["genere"] = str_replace(' ', '', $result["genere"]);
            $result["specie"] = str_replace(' ', '', $result["specie"]);
            $result["dimensioni"] = str_replace(' ', '', $result["dimensioni"]);
            $result["tipologia_foglia"] = str_replace(' ', '', $result["tipologia_foglia"]);
            $result["colore_foglia"] = str_replace(' ', '', $result["colore_foglia"]);
            $result["profumo"] = str_replace(' ', '', $result["profumo"]);
            ?>
            <li class="<?php
            echo $result["prezzo"] . ' ' .
                $result["voto"] . ' sub-' .
                $result["id_sottocategoria"] . ' ' .
                $result["famiglia"] . ' ' .
                $result["genere"] . ' ' .
                $result["specie"] . ' ' .
                $result["dimensioni"] . ' ' .
                $result["tipologia_foglia"] . ' ' .
                $result["colore_foglia"] . ' ' .
                $result["nomeGruppo"] . ' ' .
                $result["profumo"];
            ?>">
                <a href="product.php?id=<?php echo $result['nome_prodotto'] ?>">
                    <img src="./upload/prodotti/<?php echo $result['nome_prodotto'] ?>.jpg" class="product-image"
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
                </a>
            </li>
            <?php
        endforeach;
        ?>
    </ul>
</main>