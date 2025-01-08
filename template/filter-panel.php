<aside>
    <form id="filtered-search" action="search.php" method="GET">
        <label for="#more-filters-btn">Visualizza più filtri</label>
        <input type="button" id="more-filters-btn" value="Più filtri" />
        <ul>
            <li class="filter-price hidden">
                <h3>Prezzo:</h3>
                <section class="min-price">
                    <label for="min-price">Prezzo minimo</label>
                    <input type="range" id="min-price" name="min-price"
                        min="<?php echo floatval($templateParams["priceRange"][0]["min"]) ?>"
                        max="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>"
                        value="<?php echo floatval($templateParams["priceRange"][0]["min"]) ?>" step="0.1">
                    <label for="min-price-selected">Prezzo minimo selezionato</label>
                    <input type="text" id="min-price-selected"
                        value="<?php echo floatval($templateParams["priceRange"][0]["min"]) ?>" readonly />
                </section>
                <section class="max-price">
                    <label for="max-price">Prezzo massimo</label>
                    <input type="range" id="max-price" name="max-price"
                        min="<?php echo floatval($templateParams["priceRange"][0]["min"]) ?>"
                        max="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>"
                        value="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>" step="0.2">
                    <label for="max-price-selected">Prezzo massimo selezionato</label>
                    <input type="text" id="max-price-selected"
                        value="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>" readonly />
                </section>
            </li>
            <li class="filter-checkbox hidden">
                <h3>Categoria</h3>
                <ul>
                    <?php foreach ($templateParams["categorie"] as $category) {
                        $nomecategoria = $category["nome_categoria"];
                        $sottocategorie = $category["sottocategorie"];
                        echo "<li>";
                        echo '<input type="checkbox" id="' . $nomecategoria . '" name="' . $nomecategoria . '" value="' . $nomecategoria . '" class="category-selection" >';
                        echo '<label for="' . $nomecategoria . '">' . $nomecategoria . '</label>';
                        echo "<ul class='hidden " .  $nomecategoria . "-sub'>";
                        foreach ($sottocategorie as $sottocategoria) {
                            $nomesottocategoria = $sottocategoria["nome_sottocategoria"];
                            $id_sottocategoria = $sottocategoria["id_sottocategoria"];
                            echo "<li>";
                            echo '<input type="checkbox" id="' . $nomesottocategoria . '" name="sub-' . $id_sottocategoria . '" value="' . $nomesottocategoria . '">';
                            echo '<label for="' . $nomesottocategoria . '">' . $nomesottocategoria . '</label>';
                            echo "</li>";
                        }
                        echo "</ul>";
                        echo "</li>";
                    } ?>
                </ul>
            </li>
            <?php $filterAttributes = array("famiglia", "genere", "specie", "dimensioni", "profumo", "tipo di foglia", "colore delle foglie");
            foreach ($filterAttributes as $filterAttribute):
                ?>
                <li class="filter-checkbox filter-<?php echo $filterAttribute ?> hidden">
                    <h3><?php echo $filterAttribute ?></h3>
                    <ul>
                        <?php
                        for ($i = 0; $i < count($templateParams[$filterAttribute]); $i++) {
                            echo "<li>";
                            echo '<input type="checkbox" id="' . $templateParams[$filterAttribute][$i]["attributo"] . '" name="' . $templateParams[$filterAttribute][$i]["attributo"] . '" value="' . $filterAttribute . '">';
                            echo '<label for="' . $templateParams[$filterAttribute][$i]["attributo"] . '">' . $templateParams[$filterAttribute][$i]["attributo"] . '</label>';
                            echo "</li>";
                        }
                        ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
        <label for="#apply-filters-btn">Applica i filtri</label>
        <input type="button" id="apply-filters-btn" class="hidden" value="Applica Filtri" />
        <label for="#reset-filters-btn">Resetta i filtri</label>
        <input type="reset" id="reset-filters-btn" class="hidden" value="Reset" />
    </form>
</aside>