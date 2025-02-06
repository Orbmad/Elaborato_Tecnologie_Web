<aside>
    <form id="filtered-search" action="search.php" method="GET">
        <label for="more-filters-btn">Visualizza più filtri</label>
        <input type="button" id="more-filters-btn" value="Più filtri" />
        <label for="apply-filters-btn">Applica i filtri</label>
        <input type="button" id="apply-filters-btn" class="hidden" value="Applica Filtri" />
        <label for="reset-filters-btn">Resetta i filtri</label>
        <input type="reset" id="reset-filters-btn" class="hidden" value="Reset" />
        <ul>
            <li class="filter-range hidden">
                <h2>Prezzo:</h2>
                <section class="min-price">
                    <h2 class='hidden'>Selezione prezzo minimo </h2>
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
                    <h2 class='hidden'>Selezione prezzo minimo </h2>
                    <label for="max-price">Prezzo massimo</label>
                    <input type="range" id="max-price" name="max-price"
                        min="<?php echo floatval($templateParams["priceRange"][0]["min"]) ?>"
                        max="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>"
                        value="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>" step="0.1">
                    <label for="max-price-selected">Prezzo massimo selezionato</label>
                    <input type="text" id="max-price-selected"
                        value="<?php echo floatval($templateParams["priceRange"][0]["max"]) ?>" readonly />
                </section>
            </li>
            <li class="filter-range hidden">
                <h2>Valutazione minima:</h2>
                <section class="min-rating">
                    <h2 class='hidden'>Selezione prezzo minimo </h2>
                    <label for="min-rating">Rating minimo</label>
                    <input type="range" id="min-rating" name="min-rating" min="0" max="5" value="0">
                    <label for="min-rating-selected">Valutazione minima selezionata</label>
                    <input type="text" id="min-rating-selected" value="0" readonly />
                </section>
            </li>
            <li class="filter-checkbox hidden">
                <h2>Categoria</h2>
                <ul>
                    <?php foreach ($templateParams["categorie"] as $category) {
                        $nomecategoriaLabel = $category["nome_categoria"];
                        $nomecategoria = str_replace(' ', '_', $category["nome_categoria"]);
                        $sottocategorie = $category["sottocategorie"];

                        echo "<li>";
                        if (isset($templateParams["searchedCategory"])) {
                            if (str_replace(" ", "_", $templateParams["searchedCategory"]) == $nomecategoria) {
                                echo '<input type="checkbox" id="' . $nomecategoria . '" name="' . $nomecategoria . '" value="' . $nomecategoria . '" class="category-selection" checked/>';
                            } else {
                                echo '<input type="checkbox" id="' . $nomecategoria . '" name="' . $nomecategoria . '" value="' . $nomecategoria . '" class="category-selection"/>';
                            }
                        } else {
                            echo '<input type="checkbox" id="' . $nomecategoria . '" name="' . $nomecategoria . '" value="' . $nomecategoria . '" class="category-selection" checked/>';
                        }
                        echo '<label for="' . $nomecategoria . '">' . $nomecategoriaLabel . '</label>';
                        if (isset($templateParams["searchedCategory"])) {
                            if (str_replace(" ", "_", $templateParams["searchedCategory"]) == $nomecategoria) {
                                echo "<ul class=' " . $nomecategoria . "-sub'>";
                            } else {
                                echo "<ul class='hidden " . $nomecategoria . "-sub'>";
                            }
                        } else {
                            echo "<ul class='" . $nomecategoria . "-sub'>";
                        }
                        foreach ($sottocategorie as $sottocategoria) {
                            $nomesottocategoriaLabel = $sottocategoria["nome_sottocategoria"];
                            $nomesottocategoria = str_replace(' ', '_', $sottocategoria["nome_sottocategoria"]);
                            echo "<li>";
                            if (isset($templateParams["searchedCategory"])) {
                                if (str_replace(" ", "_", $templateParams["searchedCategory"]) == $nomecategoria) {
                                    if (isset($templateParams["searchedSubCategory"]) && $templateParams["searchedSubCategory"] != $nomesottocategoria) {
                                        echo '<input type="checkbox" id="' . str_replace(' ', '_', $nomesottocategoria) . '" name="sub-' . str_replace(' ', '_', $nomesottocategoria) . '" value="' . str_replace(' ', '_', $nomesottocategoria) . '">';
                                    } else {
                                        echo '<input type="checkbox" id="' . str_replace(' ', '_', $nomesottocategoria) . '" name="sub-' . str_replace(' ', '_', $nomesottocategoria) . '" value="' . str_replace(' ', '_', $nomesottocategoria) . '" checked>';
                                    }
                                } else {
                                    echo '<input type="checkbox" id="' . str_replace(' ', '_', $nomesottocategoria) . '" name="sub-' . str_replace(' ', '_', $nomesottocategoria) . '" value="' . str_replace(' ', '_', $nomesottocategoria) . '">';
                                }
                            } else {
                                echo '<input type="checkbox" id="' . str_replace(' ', '_', $nomesottocategoria) . '" name="sub-' . str_replace(' ', '_', $nomesottocategoria) . '" value="' . str_replace(' ', '_', $nomesottocategoria) . '" checked>';
                            }
                            echo '<label for="' . str_replace(' ', '_', $nomesottocategoria) . '">' . $nomesottocategoriaLabel . '</label>';
                            echo "</li>";
                        }
                        echo "</ul>";
                        echo "</li>";
                    } ?>
                </ul>
            </li>
            <?php
            foreach (array_keys($templateParams["attributesValues"]) as $filterAttribute): ?>
                <li class="filter-checkbox filter-<?php echo $filterAttribute ?> hidden">
                    <h2><?php echo str_replace('_', ' ', $filterAttribute) ?></h2>
                    <ul>
                        <?php
                        for ($i = 0; $i < count($templateParams["attributesValues"][$filterAttribute]); $i++) {
                            echo "<li>";
                            if (isset($templateParams["searchedGroup"]) && $filterAttribute === "nome_gruppo") {
                                if ($templateParams["searchedGroup"] === $templateParams["attributesValues"][$filterAttribute][$i]) {
                                    echo '<input type="checkbox" id="' . $filterAttribute . "-" . str_replace(' ', '_', $templateParams["attributesValues"][$filterAttribute][$i]) . '" name="' . str_replace(' ', '_', $templateParams["attributesValues"][$filterAttribute][$i]) . '" value="' . $filterAttribute . '" checked>';
                                } else {
                                    echo '<input type="checkbox" id="' . $filterAttribute . "-" . str_replace(' ', '_', $templateParams["attributesValues"][$filterAttribute][$i]) . '" name="' . str_replace(' ', '_', $templateParams["attributesValues"][$filterAttribute][$i]) . '" >';
                                }
                            } else {
                                echo '<input type="checkbox" id="' . $filterAttribute . "-" . str_replace(' ', '_', $templateParams["attributesValues"][$filterAttribute][$i]) . '" name="' . $filterAttribute . "-" . str_replace(' ', '_', $templateParams["attributesValues"][$filterAttribute][$i]) . '" value="' . $filterAttribute . '" checked/>';
                            }
                            echo '<label for="' . $filterAttribute . "-" . str_replace(' ', '_', $templateParams["attributesValues"][$filterAttribute][$i]) . '">' . $templateParams["attributesValues"][$filterAttribute][$i] . '</label>';
                            echo "</li>";
                        }
                        ?>
                        <?php
                        if ($filterAttribute !== "nome_gruppo") {
                            echo "<li>";
                            echo '<input type="checkbox" id="' . $filterAttribute . '-non_specificato' . '" name="' . $filterAttribute . '-non_specificato' . '" value="' . $filterAttribute . '-non_specificato' . '" checked>';
                            echo '<label for="' . $filterAttribute . '-non_specificato' . '">Non specificato</label>';
                            echo "</li>";
                        }
                        ?>

                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    </form>
</aside>
<?php
$templateParams["categoriaSelezionata"]=null;
$templateParams["sottocategoriaSelezionata"]=null;
$templateParams["sottocategoriaGroup"]=null;
$templateParams["sottocategoriaWord"]=null;
?>